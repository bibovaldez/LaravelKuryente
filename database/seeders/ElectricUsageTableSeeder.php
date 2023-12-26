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
            for ($i = 0; $i < 100; $i++) {
                DB::table('electric_usage')->insert([
                    // get the first user and meter
                    'meter_id' => $meter->id,
                    'usage' => rand(1, 1000) / 100,  // Random usage between 0.01 and 10.00
                    'recorded_at' => Carbon::now()->subSeconds($i),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
