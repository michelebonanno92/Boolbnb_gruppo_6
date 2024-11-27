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

        // $apartments = $apartments->paginate(3); 


        return response()->json([
            'success' => 'true',
            'code' => 200,
            'apartments' => $apartments
            ,
            // 'data' => [
            //     'apartments' => $apartments
            // ]
        ]);

    }

}
