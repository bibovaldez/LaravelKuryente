<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Events\meterEventPrivate;
use Illuminate\Support\Facades\Auth;

class meterWebsocketController extends Controller
{
    public function index(Request $request)
    {
        $MID = Auth::user()->F_MID;
        return view('meterLayout.metersocketPrivate', compact('MID'));
    }

    public function store(Request $request)
    {
        // dd($request->data);
        event(new meterEventPrivate($request->data));
    }
}
