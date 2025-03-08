<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductVariant;
use App\Models\ProductPrice;
use App\Models\ProductImage;
use App\Models\Variant;
use App\Models\VariantValue;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $brands = ['Zara', 'H&M', 'Gucci', 'Raymond'];
        $units = ['Piece', 'Box', 'Kilogram', 'Gram'];
        $sellingTypes = ['retail', 'wholesale'];

        // Create 10 single products
        for ($i = 1; $i <= 10; $i++) {
            $this->createSingleProduct($i, $brands, $units, $sellingTypes);
        }

        // Create 10 variable products
        for ($i = 11; $i <= 20; $i++) {
            $this->createVariableProduct($i, $brands, $units, $sellingTypes);
        }
    }

    private function createSingleProduct($i, $brands, $units, $sellingTypes)
    {
        $name = "Single Product " . $i;
        $product = Product::create([
            'name' => $name,
            'store' => 'Main Store',
            'warehouse' => 'Warehouse A',
            'sku' => 'SKU-S-' . Str::random(8),
            'slug' => Str::slug($name),
            'item_code' => 'ITEM-S-' . $i,
            'manufactured_date' => Carbon::now()->subMonths(rand(1, 6)),
            'expired_date' => Carbon::now()->addYears(rand(1, 3)),
            'unit' => $units[array_rand($units)],
            'brand' => $brands[array_rand($brands)],
            'selling_type' => $sellingTypes[array_rand($sellingTypes)],
            'description' => 'This is a single product - ' . $name,
            'discount_type' => rand(0, 1) ? 'percentage' : 'fixed',
            'discount_value' => rand(5, 20),
            'tax_type' => rand(0, 1) ? 'inclusive' : 'exclusive',
            'product_type' => 'single',
        ]);

        // Images
        $imageNumber = ($i % 10) + 1;
        ProductImage::create([
            'product_id' => $product->id,
            'image' => 'demo-products/img-' . $imageNumber . '.png',
            'is_variant' => false,
        ]);

        // Category
        ProductCategory::create([
            'product_id' => $product->id,
            'category_id' => rand(1, 3),
        ]);

        // Variant and Price
        $variant = ProductVariant::create([
            'product_id' => $product->id,
            'quantity' => rand(50, 200),
            'barcode' => str_pad(random_int(0, 999999999), 9, '0', STR_PAD_LEFT),
            'quantity_alert' => rand(10, 20),
        ]);

        $purchase_price = rand(50, 800);
        $price = $purchase_price + rand(100, 400); // Ensures selling price is higher

        ProductPrice::create([
            'product_id' => $product->id,
            'product_variant_id' => $variant->id,
            'price' => $price,
            'purchase_price' => $purchase_price,
        ]);
    }

    private function createVariableProduct($i, $brands, $units, $sellingTypes)
    {
        $name = "Variable Product " . $i;
        $product = Product::create([
            'name' => $name,
            'store' => 'Main Store',
            'warehouse' => 'Warehouse A',
            'sku' => 'SKU-V-' . Str::random(8),
            'slug' => Str::slug($name),
            'item_code' => 'ITEM-V-' . $i,
            'manufactured_date' => Carbon::now()->subMonths(rand(1, 6)),
            'expired_date' => Carbon::now()->addYears(rand(1, 3)),
            'unit' => $units[array_rand($units)],
            'brand' => $brands[array_rand($brands)],
            'selling_type' => $sellingTypes[array_rand($sellingTypes)],
            'description' => 'This is a variable product - ' . $name,
            'discount_type' => rand(0, 1) ? 'percentage' : 'fixed',
            'discount_value' => rand(5, 20),
            'tax_type' => rand(0, 1) ? 'inclusive' : 'exclusive',
            'product_type' => 'variable',
        ]);

        // Images with variants
        $imageNumber = ($i % 10) + 1;
        ProductImage::create([
            'product_id' => $product->id,
            'image' => 'demo-products/img-' . $imageNumber . '.png',
            'is_variant' => true,
            'variant_id' => 1,
            'variant_value_id' => rand(1, 3),
        ]);

        // Category
        ProductCategory::create([
            'product_id' => $product->id,
            'category_id' => rand(1, 3),
        ]);

        // Create multiple variants (Color and Size combinations)
        $colors = ['Red', 'Blue', 'Green'];
        $sizes = ['S', 'M', 'L'];

        foreach ($colors as $color) {
            foreach ($sizes as $size) {
                $variant = ProductVariant::create([
                    'product_id' => $product->id,
                    'quantity' => rand(50, 200),
                    'barcode' => str_pad(random_int(0, 999999999), 9, '0', STR_PAD_LEFT),
                    'variant_value_name' => "Color: $color, Size: $size",
                    'quantity_alert' => rand(10, 20),
                ]);

                $purchase_price = rand(50, 800);
                $price = $purchase_price + rand(100, 400); // Ensures selling price is higher

                ProductPrice::create([
                    'product_id' => $product->id,
                    'product_variant_id' => $variant->id,
                    'price' => $price,
                    'purchase_price' => $purchase_price,
                ]);



                // Create variant values
                $variant->variantValues()->create([
                    'variant_id' => 1, // Color variant
                    'variant_value_id' => array_search($color, $colors) + 1,
                ]);

                $variant->variantValues()->create([
                    'variant_id' => 2, // Size variant
                    'variant_value_id' => array_search($size, $sizes) + 4,
                ]);
            }
        }
    }
}
