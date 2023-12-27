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

    public function fetch_usage_data()
    {

        $meter = $this->meterinfo; 

        if (!$meter) {
            $usage = collect(); // return an empty collection
        } else {
            $usage = usage::where('meter_id', $meter->id)->get()->toArray();
        }

        return response()->json($usage);
    }

    public function fetch_meter_bill()
    {
        // run database query to get the meter bill
        $meterbill = DB::table('meter_bill')->where('meter_id', $this->meterinfo->id)->get()->toArray();
        return response()->json($meterbill);
    }
}
