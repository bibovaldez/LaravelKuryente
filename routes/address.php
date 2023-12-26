<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Address Routes
|--------------------------------------------------------------------------
| here is to requestr address in https://psgc.gitlab.io/api and save it to database
|
*/

Route::middleware('guest')->group(function () {
    Route::get('/address/provinces', [AddressController::class, 'getProvinces']);
    Route::get('/address/provinces/{provinceCode}/municipalities', [AddressController::class, 'getMunicipalities']);
    Route::get('/address/municipality/{municipalityCode}/barangays', [AddressController::class, 'getBarangays']);
});
