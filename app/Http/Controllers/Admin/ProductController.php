<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Variant;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductCategory;
use App\Models\ProductPrice;
use App\Models\Subcategory;
use App\Models\VariantValue;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $variants = Variant::with('variantValues')->get();

        return view('admin.product.create',compact('variants','categories','subcategories'));
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
        // Validate the request data
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
            'product_type' => 'required|in:single,variable',
            'manufactured_date' => 'nullable|date',
            'expired_date' => 'nullable|date',
            // Add other fields as needed
        ]);

        // Create the product
        $product = Product::create([
            'name' => $validatedData['name'],
            'store' => $validatedData['store'],
            'warehouse' => $validatedData['warehouse'],
            'sku' => $validatedData['sku'] ?? Str::random(10),
            'slug' => $validatedData['slug'] ?? Str::slug($validatedData['name']),
            'item_code' => $validatedData['item_code'],
            'manufactured_date' => $validatedData['manufactured_date'],
            'expired_date' => $validatedData['expired_date'],
            'unit' => $validatedData['unit'],
            'brand' => $validatedData['brand'],
            'selling_type' => $validatedData['selling_type'],
            'description' => $validatedData['description'],
        ]);

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $product->addMedia($image)->toMediaCollection('product');
            }
        }

        // Create product category
        ProductCategory::create([
            'product_id' => $product->id,
            'category_id' => $validatedData['category_id'],
            'subcategory_id' => $validatedData['subcategory_id'],
        ]);

        if ($validatedData['product_type'] === 'single') {
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
        ]);

        // Create product variant
        $variant = ProductVariant::create([
            'product_id' => $product->id,
            'quantity' => $validatedData['quantity'],
            'barcode' => $request->input('barcode') ?? Str::random(13),
        ]);

        // Create product price
        ProductPrice::create([
            'product_id' => $product->id,
            'product_variant_id' => $variant->id,
            'price' => $validatedData['price'],
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
        ]);

        foreach ($validatedData['child_products'] as $childProduct) {
            // Create product variant
            $variant = ProductVariant::create([
                'product_id' => $product->id,
                'quantity' => $childProduct['quantity'],
                'barcode' => $childProduct['barcode'] ?? Str::random(13),
                'variant_value_name' => $childProduct['combination'],
            ]);

            // Create product price
            ProductPrice::create([
                'product_id' => $product->id,
                'product_variant_id' => $variant->id,
                'price' => $childProduct['price'],
            ]);

            // Handle variant combinations
            $variantIds = explode(',', $childProduct['variant_ids']);
            $combinations = explode(', ', $childProduct['combination']);
            
            foreach ($combinations as $index => $combination) {
                list($variantName, $variantValue) = explode(': ', $combination);
                
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.product.edit');
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
        //
    }
}
