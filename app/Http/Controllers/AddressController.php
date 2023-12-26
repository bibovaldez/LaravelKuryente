<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AddressController extends Controller
{

    public function getProvinces()
    {
        $response = Http::withoutVerifying()->get('https://psgc.gitlab.io/api/provinces/');
        return $response->json();
    }

    public function getMunicipalities($provinceCode)
    {
        $response = Http::withoutVerifying()->get("https://psgc.gitlab.io/api/provinces/{$provinceCode}/municipalities/");
        return $response->json();
    }

    public function getBarangays($municipalityCode)
    {
        $response = Http::withoutVerifying()->get("https://psgc.gitlab.io/api/municipalities/{$municipalityCode}/barangays/");
        return $response->json();
    }
}
