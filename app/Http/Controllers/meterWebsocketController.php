<?php

namespace App\Http\Controllers;


use App\Models\Meter;
use App\Models\Usage;
use Illuminate\Http\Request;
use App\Events\meterEventPrivate;
use Illuminate\Support\Facades\Auth;

class meterWebsocketController extends Controller
{

    protected $meterinfo;

    public function __construct()
    {

        $this->middleware(function ($request, $next) {
            $this->meterinfo = Meter::where('MID', Auth::user()->F_MID)->first();
            return $next($request);
        });
    }
    public function index(Request $request)
    {

        $MID = Auth::user()->F_MID;
        return view('meterLayout.metersocketPrivate', compact('MID'));
    }

    public function store(Request $request)
    {
        $this->save($request->data);
        event(new meterEventPrivate($request->data));
    }
    // save data to database
    public function save($usage)
    {
        Usage::updateOrInsert(
            [
                'meter_id' => $this->meterinfo->id,
                'recorded_at' => now(),
            ],
            ['usage' => $usage]
        );
        return;
    }
}
