<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class TomTomService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.tomtom.api_key');
    }

    public function searchAddress(string $address): ?array
    {
        $query = urlencode($address);
        $url = "https://api.tomtom.com/search/2/geocode/{$query}.json?key={$this->apiKey}";

        try {
            $response = Http::withOptions([
                'verify' => false, // Disabilita la verifica SSL
            ])->get($url);

                if ($response->successful()) {
                    $data = $response->json();

                    if (isset($data['results'][0]['position'])) {
                        return [
                            'lat' => $data['results'][0]['position']['lat'],
                            'lon' => $data['results'][0]['position']['lon'],
                        ];
                    }
                    else {
                        return ['error' => 'Impossibile ottenere le coordinate per questo indirizzo.'];
                    }
                }
            } catch (\Exception $e) {
                return ['error' => $e->getMessage()];
            }
            // $response = Http::get($url);

            

        return null;
    }
}