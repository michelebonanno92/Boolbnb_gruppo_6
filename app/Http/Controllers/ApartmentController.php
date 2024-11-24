<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

// MODELS
use App\Models\ {
    Apartment,
    Message,
    Service,
    Sponsorship,
    User,
    View
};

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apartments = Apartment::all();

        return view('homepage.index', compact('apartments'));
    }

    

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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Apartment $apartment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apartment $apartment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Apartment $apartment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartment $apartment)
    {
        //
    }
}
