<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Models
use App\Models\Service;

class ServiceController extends Controller
{
    public function index() 
    {
        $services = Service::get();

        return response()->json([
            'success' => 'true',
            'code' => 200,
            'services' => $services,
            // 'data' => [
            //     'services' => $services
            // ]
        ]);

    }
}
