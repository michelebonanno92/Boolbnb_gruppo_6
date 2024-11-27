<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return response()->json(['error' => 'Query is required'], 400);
        }

        // Chiave API di TomTom
        $apiKey = config('services.tomtom.key');

        // Endpoint di geocodifica di TomTom
        $url = "https://api.tomtom.com/search/2/geocode/{$query}.json";

        // Chiamata API
        $response = Http::get($url, [
            'key' => $apiKey,
            'limit' => 5,
            'language' => 'it-IT',
            'countrySet' => 'IT',
        ]);

        // Controlla errori
        if ($response->failed()) {
            return response()->json(['error' => 'Unable to fetch data from TomTom'], 500);
        }

        return response()->json($response->json()['results']);
    }
}
