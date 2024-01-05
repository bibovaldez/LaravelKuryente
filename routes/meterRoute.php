<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\meterWebsocketController;


// meter Websocket routes
Route::middleware('auth')->group(function () {
    // meter interface
    Route::get('/meterWebsocket', [meterWebsocketController::class, 'index'])->name('meterWebsocket');
    // meter Websocket post data
    Route::post('/metersocketp', [meterWebsocketController::class, 'store'])->name('metersocketPrivate');
});

