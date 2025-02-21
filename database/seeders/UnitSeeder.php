<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            [
                'name' => 'Kilogram',
                'short_name' => 'kg',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Gram',
                'short_name' => 'g',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Piece',
                'short_name' => 'pc',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Box',
                'short_name' => 'box',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        DB::table('units')->insert($units);
    }
    
}
