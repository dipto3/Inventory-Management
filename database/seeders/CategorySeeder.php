<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Electronics',
                'parent_id' => 0,
                'slug' => Str::slug('Electronics'),
                'ordering' => 1,
                'description' => 'Electronic devices and accessories',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Clothing',
                'parent_id' => 0,
                'slug' => Str::slug('Clothing'),
                'ordering' => 2,
                'description' => 'Fashion and apparel items',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Home & Living',
                'parent_id' => 0,
                'slug' => Str::slug('Home & Living'),
                'ordering' => 3,
                'description' => 'Home decor and living essentials',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        DB::table('categories')->insert($categories);
    }
}
