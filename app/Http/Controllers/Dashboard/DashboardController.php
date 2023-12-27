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
     * @param  string  $time_unit
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

    public function fetch_usage_data($time_unit)
    {
        switch ($time_unit) {
            case 'min':
                $usage = DB::table('electric_usage')->where('meter_id', $this->meterinfo->id)->get()->toArray();
                return response()->json($usage);
                break;
            case 'hour':
                $usage = DB::table('1hour_usage')->where('meter_id', $this->meterinfo->id)->get()->toArray();
                return response()->json($usage);
                break;
            case 'day':
                $usage = DB::table('1day_usage')->where('meter_id', $this->meterinfo->id)->get()->toArray();
                return response()->json($usage);
                break;
            case 'month':
                $usage = DB::table('1month_usage')->where('meter_id', $this->meterinfo->id)->get()->toArray();
                return response()->json($usage);
                break;
            default:
                return response()->json("Invalid time unit");
                break;
        }
    }

    public function fetch_meter_bill()
    {
        // run database query to get the meter bill
        $meterbill = DB::table('meter_bill')->where('meter_id', $this->meterinfo->id)->get()->toArray();
        return response()->json($meterbill);
    }
}
