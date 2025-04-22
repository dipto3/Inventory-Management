<?php
namespace Database\Seeders;


use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $discountTypes = ['percentage', 'amount'];

        for ($i = 0; $i < 20; $i++) {
            $startDate = Carbon::now()->addDays(rand(-5, 30));
            $endDate   = (clone $startDate)->addDays(rand(5, 60));

            DB::table('coupons')->insert([
                'code'                    => strtoupper(Str::random(8)),
                'discount_type'           => $discountTypes[array_rand($discountTypes)],
                'discount_value'          => rand(5, 50),
                'minimum_order_amount'    => rand(100, 1000),
                'maximum_discount_amount' => rand(50, 500),
                'start_date'              => $startDate->format('Y-m-d'),
                'start_time'              => $startDate->format('H:i:s'),
                'end_date'                => $endDate->format('Y-m-d'),
                'end_time'                => $endDate->format('H:i:s'),
                'usage_limit'             => rand(1, 100),
                'status'                  => rand(0, 1),
                'created_at'              => now(),
                'updated_at'              => now(),
            ]);
        }
    }
}
