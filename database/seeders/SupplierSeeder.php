<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            [
                'name' => 'Fashion Forward Ltd',
                'email' => 'contact@fashionforward.com',
                'phone' => '+1234567890',
                'address' => '123 Fashion Avenue',
                'city' => 'Milan',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Textile Masters',
                'email' => 'info@textilemasters.com', 
                'phone' => '+1987654321',
                'address' => '456 Fabric Street',
                'city' => 'Paris',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Trendy Threads Inc',
                'email' => 'sales@trendythreads.com',
                'phone' => '+1122334455',
                'address' => '789 Style Boulevard',
                'city' => 'New York',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Designer Wholesale',
                'email' => 'orders@designerwholesale.com',
                'phone' => '+1555666777',
                'address' => '321 Couture Lane',
                'city' => 'London',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        Supplier::insert($suppliers);
    }
}
