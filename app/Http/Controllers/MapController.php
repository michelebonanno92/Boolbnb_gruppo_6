<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
    public function getPoints()
    {
        // Dati di esempio (simula dati reali)
        $points = [
            ['lat' => 52.377956, 'lon' => 4.897070, 'name' => "Ristorante Italiano"],
            ['lat' => 52.376447, 'lon' => 4.908168, 'name' => "Caffetteria Centrale"],
            ['lat' => 52.378612, 'lon' => 4.900254, 'name' => "Parco Locale"]
        ];

        return response()->json($points);
    }
}
