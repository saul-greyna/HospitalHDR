<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GoogleController extends Controller
{
    public function reviews()
    {
        $response = Http::get('https://maps.googleapis.com/maps/api/place/details/json', [
            'place_id' => 'ChIJM5BbtAm_K4QRHAsAYL9UnRc',
            'fields' => 'name,rating,reviews',
            'language' => 'es',
            'key' => env('GOOGLE_PLACES_KEY')
        ]);

        return $response->json();
    }
}
