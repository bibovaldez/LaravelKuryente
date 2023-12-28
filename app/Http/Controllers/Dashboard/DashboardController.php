<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Meter;
use App\Models\usage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Fetch usage data based on the provided time unit.
     *
     * @param  string  $unit
     * @return \Illuminate\Http\Response
     */
    protected $meterinfo;



    public function __construct()
    {

        $this->middleware(function ($request, $next) {
            $this->meterinfo = Meter::where('MID', Auth::user()->F_MID)->first();
            return $next($request);
        });
    }

    public function index()
    {
        $meterinfo = $this->meterinfo; // Add this line to define $meterinfo
        return view('dashboard', compact('meterinfo'));
    }

    public function fetch_usage_data($unit)
    {
        $tableNames = [
            'min' => 'electric_usage',
            'hour' => '1min_usage',
            'day' => '1hour_usage',
            'month' => '1day_usage',
            'year' => '1month_usage',
        ];

        if (!array_key_exists($unit, $tableNames)) {
            // Log an error message
            error_log("Invalid unit value: $unit");
            // Return an error response
            return response()->json(['error' => 'Invalid unit value'], 400);
            return;
        }

        $usage = DB::table($tableNames[$unit])
            ->where('meter_id', $this->meterinfo->id)
            ->get()
            ->toArray();

        return response()->json($usage);
    }


    public function fetch_meter_bill()
    {
        // run database query to get the meter bill
        $meterbill = DB::table('meter_bill')->where('meter_id', $this->meterinfo->id)->get()->toArray();
        return response()->json($meterbill);
    }
}
