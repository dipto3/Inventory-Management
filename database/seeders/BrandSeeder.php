<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            [
                'name' => 'Zara',
                'description' => 'Fast fashion retail brand',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'H&M',
                'description' => 'Fashion and accessories retailer',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Gucci',
                'description' => 'Luxury fashion house',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Raymond',
                'description' => 'Raymond fashion house',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        DB::table('brands')->insert($brands);
    }
}
