<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\ProductPrice;
use App\Models\ProductVariant;
use App\Models\Unit;
use App\Models\Variant;
use App\Models\VariantValue;
use App\Rules\QuantityAlertRule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Picqer\Barcode\BarcodeGeneratorPNG;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function testRoute(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'name' => 'required|string|max:255',
    //     ]);

    // }
    public function index()
    {
        // $products = Cache::remember('products', now()->addMinutes(10), function () {
        //     return Product::with('variants', 'variants.prices', 'categories')->orderBy('id', 'desc')->get()->values();;
        // });
        // $products = Product::with('variants', 'productImage', 'variants.prices', 'categories')->get();
        $products = Product::select('id', 'name', 'sku', 'brand', 'unit')
            ->with([
                'variants:id,product_id,variant_value_name,quantity,quantity_alert,barcode',
                'productImage:id,product_id,image',
                'variants.prices:id,product_variant_id,price',
                'categories:id,name',
            ])
            ->get();
        // dd($products);
        return view('admin.product.index', compact('products'));
    }

    public function expiredProducts()
    {
        // dd(now()->toDateString());
        $products = Product::with('productImage','categories','variants.prices')->where('expired_date', '<', now()->toDateString())->with('variants', 'prices')->get();
        // dd($products );
        return view('admin.product.expired-products', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('parent_id', 0)
            ->with('childrenCategories')
            ->select('id', 'name')->get();
        $brands   = Brand::where('status', 1)->select('id', 'name')->get();
        $units    = Unit::where('status', 1)->select('id', 'name', 'short_name')->get();
        $variants = Variant::with('variantValues')->get();
        return view('admin.product.create', compact('variants', 'categories', 'brands', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Validation rules
        $validatedData = $request->validate([
            'name'              => 'required|string|max:255',
            'store'             => 'required|string|max:255',
            'warehouse'         => 'required|string|max:255',
            'sku'               => 'required|string|max:255|unique:products',
            'slug'              => 'nullable|string|max:255|unique:products',
            'unit'              => 'required|string|max:255',
            'brand'             => 'required|string|max:255',
            'selling_type'      => 'required|string|max:255',
            'description'       => 'nullable|string',
            'category_id'       => 'required|array',
            'category_id.*'     => 'exists:categories,id',
            'productType'       => 'required|in:single,variable',
            'manufactured_date' => 'nullable|date',
            'expired_date'      => 'nullable|date',
            'item_code'         => 'nullable',
            'discount_type'     => 'nullable',
            'discount_value'    => 'nullable',
            'tax_type'          => 'nullable',
            'is_featured'       => 'nullable',
        ]);

        DB::beginTransaction();
        try {
            $product = Product::create([
                'name'              => $validatedData['name'],
                'store'             => $validatedData['store'],
                'warehouse'         => $validatedData['warehouse'],
                'sku'               => $validatedData['sku'] ?? Str::random(10),
                'slug'              => $validatedData['slug'] ?? Str::slug($validatedData['name']),
                'item_code'         => $validatedData['item_code'],
                'manufactured_date' => isset($validatedData['manufactured_date']) ? Carbon::parse($validatedData['manufactured_date']) : null,
                'expired_date'      => isset($validatedData['expired_date']) ? Carbon::parse($validatedData['expired_date']) : null,
                'unit'              => $validatedData['unit'],
                'brand'             => $validatedData['brand'],
                'selling_type'      => $validatedData['selling_type'],
                'description'       => $validatedData['description'],
                'discount_type'     => $validatedData['discount_type'],
                'discount_value'    => $validatedData['discount_value'],
                'tax_type'          => $validatedData['tax_type'],
                'product_type'      => $validatedData['productType'],
                'category_id'       => json_encode($validatedData['category_id']),
                'is_featured'       => $validatedData['is_featured'] ?? 0,
            ]);

            // Handle images
            if ($request->image_type === 'variant') {
                $variantImages = $request->file('variant_images');
                foreach ($variantImages as $variant_value_id => $imageArray) {
                    foreach ($imageArray as $image) {
                        $imagePath = $image->store('product_images', 'public');
                        $product->productImage()->create([
                            'image'            => $imagePath,
                            'variant_id'       => $request->imageVariant_id,
                            'variant_value_id' => $variant_value_id,
                            'is_variant'       => true,
                        ]);
                    }
                }
            } else {
                if ($request->hasFile('image')) {
                    foreach ($request->file('image') as $image) {
                        $product->productImage()->create([
                            'image'      => $image->store('product_images', 'public'),
                            'is_variant' => false,
                        ]);
                    }
                }
            }

            // Create product categories
            foreach ($validatedData['category_id'] as $categoryId) {
                ProductCategory::create([
                    'product_id'  => $product->id,
                    'category_id' => $categoryId,
                ]);
            }

            // Handle product types
            if ($validatedData['productType'] === 'single') {
                $this->handleSingleProduct($product, $request);
            } else {
                $this->handleVariableProduct($product, $request);
            }

            // Commit transaction
            DB::commit();
            // return redirect()->route('product.index')->with('success', 'Product created successfully.');
            return response()->json([
                'success' => true,
                'message' => 'product created successfully',
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ], 500);
        }
    }

    private function handleSingleProduct(Product $product, Request $request)
    {

        $validatedData = $request->validate([
            'quantity'       => 'required|integer|min:0',
            'price'          => 'required|numeric|min:0',
            'purchase_price' => 'required|numeric|min:0',
            'quantity_alert' => ['required', 'numeric', new QuantityAlertRule()],
        ]);

        $variant = ProductVariant::create([
            'product_id'     => $product->id,
            'quantity'       => $validatedData['quantity'],
            'barcode'        => str_pad(random_int(0, 999999999), 9, '0', STR_PAD_LEFT),
            'quantity_alert' => $validatedData['quantity_alert'],

            // 'variant_value_price' => $validatedData['variant_value_price'],

        ]);

        ProductPrice::create([
            'product_id'         => $product->id,
            'product_variant_id' => $variant->id,
            'price'              => $validatedData['price'],
            'purchase_price'     => $validatedData['purchase_price'],
        ]);
    }

    private function handleVariableProduct(Product $product, Request $request)
    {

        // dd($request->child_products);
        $validatedData = $request->validate([
            'child_products'                  => 'required|array',
            'child_products.*.combination'    => 'required|string',
            'child_products.*.variant_ids'    => 'required|string',
            'child_products.*.barcode'        => 'nullable|string',
            'child_products.*.quantity'       => 'required|integer|min:0',
            'child_products.*.price'          => 'required|numeric|min:0',
            'child_products.*.purchase_price' => 'required|numeric|min:0',
            'child_products.*.quantity_alert' => 'required|integer|min:0',
        ]);

        foreach ($validatedData['child_products'] as $childProduct) {
            // Create product variant
            $variant = ProductVariant::create([
                'product_id'         => $product->id,
                'quantity'           => $childProduct['quantity'],
                'barcode'            => str_pad(random_int(0, 999999999), 9, '0', STR_PAD_LEFT),
                'variant_value_name' => $childProduct['combination'],
                // 'variant_value_price' => $childProduct['price'],
                'quantity_alert'     => $childProduct['quantity_alert'],
            ]);

            // Create product price
            ProductPrice::create([
                'product_id'         => $product->id,
                'product_variant_id' => $variant->id,
                'price'              => $childProduct['price'],
                'purchase_price'     => $childProduct['purchase_price'],
            ]);

            // Handle variant combinations
            $variantIds = explode(',', $childProduct['variant_ids']);
            // $variantIds = array_map('trim', explode(',', $childProduct['variant_ids']));
            // dd("Extracted Variant IDs:", compact('variantIds'));
            $combinations = explode(', ', $childProduct['combination']);

            foreach ($combinations as $index => $combination) {
                list($variantName, $variantValue) = explode(': ', $combination);
                // dd($variantIds[$index]);
                // Find the variant and variant value
                $variantModel = Variant::find($variantIds[$index]);

                $variantValue = trim(strtolower($variantValue));

                $variantValueModel = VariantValue::where('value', $variantValue)
                    ->where('variant_id', (int) $variantModel->id)
                    ->first();

                if ($variantModel && $variantValueModel) {
                    // Create a new entry in product_variant_values table
                    $variant->variantValues()->create([
                        'variant_id'       => $variantModel->id,
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
    {}

    public function viewDetails(string $productID, $variantID)
    {
        $product   = Product::with('variants', 'prices')->findOrFail($productID);
        $variant   = ProductVariant::findOrFail($variantID);
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
        $product    = Product::with('variants', 'variants.variantValues', 'variants.prices', 'categories', 'singleProduct', 'variantProducts', 'variantProducts.variantValues.variant', 'variantProducts.prices')->findOrFail($id);
        $categories = Category::where('parent_id', 0)
            ->with('childrenCategories')
            ->select('id', 'name')->get();
        $brands   = Brand::all();
        $units    = Unit::all();
        $variants = Variant::with('variantValues')->get();
        // dd($variants->first()->variantValues);
        return view('admin.product.edit', compact('product', 'categories', 'brands', 'units', 'variants'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $product = Product::findOrFail($id);

            $product->update([
                'name'              => $request->name,
                'store'             => $request->store,
                'warehouse'         => $request->warehouse,
                'sku'               => $request->sku ?? $product->sku,
                'slug'              => $request->slug ?? Str::slug($request->name),
                'item_code'         => $request->item_code,
                'manufactured_date' => $request->manufactured_date ? Carbon::parse($request->manufactured_date) : null,
                'expired_date'      => $request->expired_date ? Carbon::parse($request->expired_date) : null,
                'unit'              => $request->unit,
                'brand'             => $request->brand,
                'selling_type'      => $request->selling_type,
                'description'       => $request->description,
                'discount_type'     => $request->discount_type,
                'discount_value'    => $request->discount_value,
                'tax_type'          => $request->tax_type,
                'product_type'      => $request->productType,
            ]);

            $product->productCategories()->delete(); // Remove old categories
            foreach ($request->category_id as $categoryId) {
                ProductCategory::create([
                    'product_id'  => $product->id,
                    'category_id' => $categoryId,
                ]);
            }

            if ($request->image_type === 'variant' && $request->file('variant_images')) {
                foreach ($request->file('variant_images') as $variant_value_id => $imageArray) {
                    foreach ($imageArray as $image) {
                        $imagePath = $image->store('product_images', 'public');
                        $product->productImage()->create([
                            'image'            => $imagePath,
                            'variant_id'       => $request->imageVariant_id,
                            'variant_value_id' => $variant_value_id,
                            'is_variant'       => true,
                        ]);
                    }
                }
            } elseif ($request->file('image')) {
                foreach ($request->file('image') as $image) {
                    $product->productImage()->create([
                        'image'      => $image->store('product_images', 'public'),
                        'is_variant' => false,
                    ]);
                }
            }

            // Update product variants based on type
            if ($product->product_type === 'single') {

                $this->updateSingleProduct($product, $request);
            } else {
                $this->updateVariableProduct($product, $request);
            }

            DB::commit();
            return redirect()->route('product.index')->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Failed to update product. ' . $e->getMessage())
                ->withInput();
        }
    }

    private function updateSingleProduct(Product $product, Request $request)
    {
        $validatedData = $request->validate([
            'quantity'       => 'nullable|integer|min:0',
            'price'          => 'nullable|numeric|min:0',
            'purchase_price' => 'nullable|numeric|min:0',
            'quantity_alert' => ['nullable', 'numeric', new QuantityAlertRule()],
        ]);
        if (! $validatedData) {
            return response()->json(['error' => 'Validation failed'], 422);
        }

        $variant = $product->variants()->first();

        $variant->update([
            'quantity'       => (int) $validatedData['quantity'],
            'quantity_alert' => (int) $validatedData['quantity_alert'],
        ]);

        ProductPrice::where('product_variant_id', $variant->id)->update([
            'price'          => (int) $validatedData['price'],
            'purchase_price' => (int) $validatedData['purchase_price'],
        ]);
    }

    private function updateVariableProduct(Product $product, Request $request)
    {
        if (! $request->has('child_products')) {
            return;
        }
        // dd($request->child_products['0']['combination']);
        $validatedData = $request->validate([
            'child_products'                  => 'nullable|array',
            'child_products.*.id'             => 'nullable|exists:product_variants,id',
            'child_products.*.combination'    => 'required|string',
            'child_products.*.quantity'       => 'nullable|integer|min:0',
            'child_products.*.price'          => 'nullable|numeric|min:0',
            'child_products.*.purchase_price' => 'nullable|numeric|min:0',
            'child_products.*.quantity_alert' => 'nullable|integer|min:0',
        ]);
        // dd($validatedData['child_products']);

        $newVariantIds = [];
        foreach ($validatedData['child_products'] as $childProduct) {
            $variant = $product->variants()->updateOrCreate(
                ['variant_value_name' => $childProduct['combination']],
                [
                    'quantity'       => $childProduct['quantity'],
                    'quantity_alert' => $childProduct['quantity_alert'],
                ]
            );
            // dd($variant);
            $newVariantIds[] = $variant->id;
            ProductPrice::updateOrCreate(
                ['product_variant_id' => $variant->id],
                [
                    'product_id'     => $product->id,
                    'price'          => $childProduct['price'],
                    'purchase_price' => $childProduct['purchase_price'],
                ]
            );
        }
        $product->variants()->whereNotIn('id', $newVariantIds)->delete();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        // $product->productCategories()->delete();

        // $product->variants()->delete();

        // $product->prices()->delete();

        foreach ($product->productImage as $image) {
            Storage::disk('public')->delete($image->image);
            $image->delete();
        }
        $product->delete();

        return response()->json(['success' => true]);
    }

    public function deleteImage($id)
    {
        $image = ProductImage::findOrFail($id);

        // Delete file from storage
        if (Storage::exists('public/' . $image->image)) {
            Storage::delete('public/' . $image->image);
        }

        $image->delete();

        return response()->json(['success' => true]);
    }
}
