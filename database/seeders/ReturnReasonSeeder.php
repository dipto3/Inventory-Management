<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReturnReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $returnReasons = [
            [
                'reason'      => 'Wrong Size',
                'description' => 'Product did not fit as expected',
                'status'      => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'reason'      => 'Wrong Item Received',
                'description' => 'Received different product than ordered',
                'status'      => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'reason'      => 'Defective Product',
                'description' => 'Product arrived damaged or not working',
                'status'      => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'reason'      => 'Changed Mind',
                'description' => 'No longer want the product',
                'status'      => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'reason'      => 'Better Price Available',
                'description' => 'Found the product cheaper elsewhere',
                'status'      => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],

           
        ];

        DB::table('return_reasons')->insert($returnReasons);
    }
}
