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
    public function show(string $slug) 
    {
        $apartment = Apartment::get()->where('slug', $slug)->first();

        // if ($apartment->cover) {
        //     $apartment->cover = asset('storage/'.$apartment->cover);
        // }

        if ($apartment) {
            return response()->json([
                'success' => true,
                'code' => 200,
                'message' => 'Ok',
                'apartment' => $apartment
            ]);
        }
        else {
            return response()->json([
                'success' => false,
                'code' => 404,
                'message' => 'apartment not found',
            ], 404);
        }

        
    }

}
