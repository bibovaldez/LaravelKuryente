<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Meter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ElectricUsageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all users and meters
        $meters = Meter::all();
        foreach ($meters as $meter) {
            // Generate random usage data for each user and meter
            for ($i = 100; $i > 0; $i--) {
                DB::table('electric_usage')->insert([
                    // get the first user and meter
                    'meter_id' => $meter->id,
                    // Random usage between 0.001  and 0.003
                    'usage' => (0.001 + mt_rand() / getrandmax() * (0.003 - 0.001)),
                    'recorded_at' => Carbon::now()->subSeconds($i),
                ]);
            }
        }

        // seed the monthly bill
        foreach ($meters as $meter) {
            for ($i = 12; $i > 0; $i--) {
                DB::table('monthly_bill')->insert([
                    'meter_id' => $meter->id,
                    'year_month' => Carbon::now()->subMonths($i)->format('Y-m'),
                    'bill_amount' => mt_rand(100, 1000),
                ]);
            }
        }
        // seed the 1min_usage
        foreach ($meters as $meter) {
            $usagemarkk = 0; // Initialize usagemarkk for each meter
            for ($i = 60; $i > 0; $i--) {
                $usage = round((0.011 + mt_rand() / getrandmax() * (0.033 - 0.011)), 6);
                $usagemarkk += $usage;
                $usagemarkround = round($usagemarkk, 6);
                DB::table('1min_usage')->insert([
                    'meter_id' => $meter->id,
                    'usage' => $usage,
                    'recorded_at' => Carbon::now()->subSeconds($i),
                    'usagemark' => $usagemarkround,
                ]);
            }
        }

        // seed the 1hour_usage
        foreach ($meters as $meter) {
            $usagemarkk = 0; // Initialize usagemarkk for each meter
            for ($i = 24; $i > 0; $i--) {
                $usage =  round((0.1369 + mt_rand() / getrandmax() * (0.2739 - 0.1369)),6);
                $usagemarkk += $usage;
                $usagemarkround = round($usagemarkk, 6);
                DB::table('1hour_usage')->insert([
                    'meter_id' => $meter->id,
                    'usage' => $usage,
                    'recorded_at' => Carbon::now()->subHours($i),
                    'usagemark' => $usagemarkround,
                ]);
            }
        }


        // seed the 1day_usage
        foreach ($meters as $meter) {
            for ($i = 30; $i > 0; $i--) {
                $usage = round((3.33 + mt_rand() / getrandmax() * (6.66 - 3.33)), 6);
                $usagemarkk += $usage;
                $usagemarkround = round($usagemarkk, 6);
                DB::table('1day_usage')->insert([
                    'meter_id' => $meter->id,
                    'usage' => $usage,
                    'recorded_at' => Carbon::now()->subDays($i),
                    'usagemark' => $usagemarkround,
                ]);
            }
        }

        // seed the 1month_usage
        foreach ($meters as $meter) {
            for ($i = 12; $i > 0; $i--) {
                $usage = round((100 + mt_rand() / getrandmax() * (200 - 100)), 6);
                $usagemarkk += $usage;
                $usagemarkround = round($usagemarkk, 6);
                DB::table('1month_usage')->insert([
                    'meter_id' => $meter->id,
                    'usage' => $usage,
                    'recorded_at' => Carbon::now()->subMonths($i),
                    'usagemark' => $usagemarkround,
                ]);
            }
        }
    }
}
