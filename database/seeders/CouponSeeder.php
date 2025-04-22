<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners = [
            [
                'title'      => 'Summer Sale',
                'image'      => 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d',
                'link'       => 'http://inventory.test/coupon',
                'status'     => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title'      => 'New Collection',
                'image'      => 'https://images.unsplash.com/photo-1483985988355-763728e1935b',
                'link'       => 'http://inventory.test/coupon',
                'status'     => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title'      => 'Limited Time Offer',
                'image'      => 'https://images.unsplash.com/photo-1544441893-675973e31985',
                'link'       => 'http://inventory.test/coupon',
                'status'     => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title'      => 'Winter Special',
                'image'      => 'https://images.unsplash.com/photo-1511499767150-a48a237f0083',
                'link'       => 'http://inventory.test/coupon',
                'status'     => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('banners')->insert($banners);
    }
}
