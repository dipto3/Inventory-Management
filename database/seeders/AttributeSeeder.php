<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert variants
        $colorVariantId = DB::table('variants')->insertGetId([
            'name' => 'Color',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $sizeVariantId = DB::table('variants')->insertGetId([
            'name' => 'Size',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert variant values for Color
        DB::table('variant_values')->insert([
            ['variant_id' => $colorVariantId, 'value' => 'Red', 'created_at' => now(), 'updated_at' => now()],
            ['variant_id' => $colorVariantId, 'value' => 'Blue', 'created_at' => now(), 'updated_at' => now()],
            ['variant_id' => $colorVariantId, 'value' => 'Green', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Insert variant values for Size
        DB::table('variant_values')->insert([
            ['variant_id' => $sizeVariantId, 'value' => 'S', 'created_at' => now(), 'updated_at' => now()],
            ['variant_id' => $sizeVariantId, 'value' => 'M', 'created_at' => now(), 'updated_at' => now()],
            ['variant_id' => $sizeVariantId, 'value' => 'L', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
