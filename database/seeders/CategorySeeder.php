<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert categories
        $categories = [
            ['name' => 'Man', 'description' => 'Category for men', 'status' => 1],
            ['name' => 'Woman', 'description' => 'Category for women', 'status' => 1],
        ];

        DB::table('categories')->insert($categories);

        // Retrieve the inserted category IDs
        $categoryIds = DB::table('categories')->pluck('id', 'name');

        // Insert subcategories
        $subcategories = [
            ['category_id' => $categoryIds['Man'], 'name' => 'Shirts', 'description' => 'Shirts for men', 'status' => 1],
            ['category_id' => $categoryIds['Man'], 'name' => 'Pants', 'description' => 'Pants for men', 'status' => 1],
            ['category_id' => $categoryIds['Woman'], 'name' => 'Dresses', 'description' => 'Dresses for women', 'status' => 1],
            ['category_id' => $categoryIds['Woman'], 'name' => 'Skirts', 'description' => 'Skirts for women', 'status' => 1],
        ];

        DB::table('subcategories')->insert($subcategories);
    }
}
