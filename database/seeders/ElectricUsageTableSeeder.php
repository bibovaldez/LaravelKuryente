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
    }
}
