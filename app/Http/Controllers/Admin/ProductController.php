<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Variant;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductCategory;
use App\Models\ProductPrice;
use App\Models\Subcategory;
use App\Models\Unit;
use App\Models\VariantValue;
use App\Rules\QuantityAlertRule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Picqer\Barcode\BarcodeGeneratorPNG;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('variants', 'prices')->get();
        return view('admin.product.index', compact('products'));
    }

    public function expiredProducts()
    {
        // dd(now()->toDateString());
        $products = Product::where('expired_date', '<', now()->toDateString())->with('variants', 'prices')->get();
        // dd($products );
        return view('admin.product.expired-products', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $brands = Brand::where('status', 1)->get();
        $units = Unit::where('status', 1)->get();
        $variants = Variant::with('variantValues')->get();

        return view('admin.product.create', compact('variants', 'categories', 'subcategories', 'brands', 'units'));
    }

    public function ed()
    {
        return view('admin.product.edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'store' => 'nullable|string|max:255',
            'warehouse' => 'nullable|string|max:255',
            'sku' => 'nullable|string|max:255|unique:products',
            'slug' => 'nullable|string|max:255|unique:products',
            'unit' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'selling_type' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'productType' => 'required|in:single,variable',
            'manufactured_date' => 'nullable|date',
            'expired_date' => 'nullable|date',
            'item_code' => 'nullable',
            // 'quantity' => 'required|integer|min:0',
            // 'quantity_alert' => ['required', 'numeric', new QuantityAlertRule()],
            'discount_type' => 'nullable',
            'discount_value' => 'nullable',
            'tax_type' => 'nullable',
            'productType' => 'required|in:single,variable',

        ]);

        // Create the product
        $product = Product::create([
            'name' => $validatedData['name'],
            'store' => $validatedData['store'],
            'warehouse' => $validatedData['warehouse'],
            'sku' => $validatedData['sku'] ?? Str::random(10),
            'slug' => $validatedData['slug'] ?? Str::slug($validatedData['name']),
            'item_code' => $validatedData['item_code'],
            'manufactured_date' => isset($validatedData['manufactured_date']) ? Carbon::parse($validatedData['manufactured_date']) : null,
            'expired_date' => isset($validatedData['expired_date']) ? Carbon::parse($validatedData['expired_date']) : null,
            'unit' => $validatedData['unit'],
            'brand' => $validatedData['brand'],
            'selling_type' => $validatedData['selling_type'],
            'description' => $validatedData['description'],
            'discount_type' => $validatedData['discount_type'],
            'discount_value' => $validatedData['discount_value'],
            'tax_type' => $validatedData['tax_type'],
            'product_type' => $validatedData['productType']
        ]);

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $product->addMedia($image)->toMediaCollection();
            }
        }


        ProductCategory::create([
            'product_id' => $product->id,
            'category_id' => $validatedData['category_id'],
            'subcategory_id' => $validatedData['subcategory_id'],
        ]);

        if ($validatedData['productType'] === 'single') {
            // Handle single product
            $this->handleSingleProduct($product, $request);
        } else {
            // Handle variable product
            $this->handleVariableProduct($product, $request);
        }

        return redirect()->route('product.index')->with('success', 'Product created successfully.');
    }

    private function handleSingleProduct(Product $product, Request $request)
    {
        // Validate single product specific data
        $validatedData = $request->validate([
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'purchase_price' => 'required|numeric|min:0',
            'quantity_alert' => ['required', 'numeric', new QuantityAlertRule()],
        ]);

        // Create product variant
        $variant = ProductVariant::create([
            'product_id' => $product->id,
            'quantity' => $validatedData['quantity'],
            'barcode' => str_pad(random_int(0, 999999999), 9, '0', STR_PAD_LEFT),
            'quantity_alert' => $validatedData['quantity_alert'],

            // 'variant_value_price' => $validatedData['variant_value_price'],

        ]);

        // Create product price
        ProductPrice::create([
            'product_id' => $product->id,
            'product_variant_id' => $variant->id,
            'price' => $validatedData['price'],
            'purchase_price' => $validatedData['purchase_price'],
        ]);
    }

    private function handleVariableProduct(Product $product, Request $request)
    {
        // Validate variable product specific data
        $validatedData = $request->validate([
            'child_products' => 'required|array',
            'child_products.*.combination' => 'required|string',
            'child_products.*.variant_ids' => 'required|string',
            'child_products.*.barcode' => 'nullable|string',
            'child_products.*.quantity' => 'required|integer|min:0',
            'child_products.*.price' => 'required|numeric|min:0',
            'child_products.*.purchase_price' => 'required|numeric|min:0',
            // 'child_products.*.quantity_alert' => ['required', 'numeric', new QuantityAlertRule()],
            'child_products.*.quantity_alert' =>  'required|integer|min:0',
        ]);

        foreach ($validatedData['child_products'] as $childProduct) {
            // Create product variant
            $variant = ProductVariant::create([
                'product_id' => $product->id,
                'quantity' => $childProduct['quantity'],
                'barcode' => str_pad(random_int(0, 999999999), 9, '0', STR_PAD_LEFT),
                'variant_value_name' => $childProduct['combination'],
                // 'variant_value_price' => $childProduct['price'],
                'quantity_alert' => $childProduct['quantity_alert'],
            ]);

            // Create product price
            ProductPrice::create([
                'product_id' => $product->id,
                'product_variant_id' => $variant->id,
                'price' => $childProduct['price'],
                'purchase_price' => $childProduct['purchase_price'],
            ]);

            // Handle variant combinations
            $variantIds = explode(',', $childProduct['variant_ids']);
            $combinations = explode(', ', $childProduct['combination']);

            foreach ($combinations as $index => $combination) {
                list($variantName, $variantValue) = explode(': ', $combination);
                // dd($variantIds[$index]);
                // Find the variant and variant value
                $variantModel = Variant::find($variantIds[$index]);
                $variantValueModel = VariantValue::where('value', $variantValue)
                    ->where('variant_id', $variantModel->id)
                    ->first();

                if ($variantModel && $variantValueModel) {
                    // Create a new entry in product_variant_values table
                    $variant->variantValues()->create([
                        'variant_id' => $variantModel->id,
                        'variant_value_id' => $variantValueModel->id,
                    ]);
                }
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    public function viewDetails(string $productID, $variantID)
    {
        $product = Product::with('variants', 'prices')->findOrFail($productID);
        $variant = ProductVariant::findOrFail($variantID);
        $generator = new BarcodeGeneratorPNG();

        // Generate the barcode image
        $barcodeImage = base64_encode($generator->getBarcode($variant->barcode, $generator::TYPE_CODE_128));
        return view('admin.product.view-details', compact('variant', 'product', 'barcodeImage'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $brands = Brand::all();
        $units = Unit::all();
        $variants = Variant::with('variantValues')->get();

        return view('admin.product.edit', compact('product', 'categories', 'subcategories', 'brands', 'units', 'variants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->back()->with('info', 'Product Deleted successfully.');
    }
}
