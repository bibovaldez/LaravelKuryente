<?php

namespace App\Http\Controllers;

use App\Models\Meter;
use App\Models\Usage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{


    public function index()
    {
        $meterinfo = Meter::where('MID', Auth::user()->F_MID)->first();

        // Check if meterinfo is not null before trying to get the usage
        if (!$meterinfo) {
            $usage = collect(); // return an empty collection
        } else {
            $usage = Usage::where('meter_id', $meterinfo->id)->get()->toArray();
        }
        // get the average
        
        return view('dashboard', compact('meterinfo', 'usage'));
    }
}
