<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\meterWebsocketController;
use App\Http\Middleware\Role;

// meter Websocket routes
Route::middleware('auth')->group(function () {
    // meter interface
    Route::get('/meterWebsocket', [meterWebsocketController::class, 'index']);
    // meter Websocket post data
    Route::post('/metersocketp', [meterWebsocketController::class, 'store'])->name('metersocketPrivate');
});

