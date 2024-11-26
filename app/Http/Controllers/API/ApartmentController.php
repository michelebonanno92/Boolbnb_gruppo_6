<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Models
use App\Models\Apartment;

class ApartmentController extends Controller
{
    
    public function index() 
    {
        $apartments = Apartment::get();

        return response()->json([
            'success' => 'true',
            'code' => 200,
            'data' => [
                'apartments' => $apartments
            ]
        ]);

    }

}
