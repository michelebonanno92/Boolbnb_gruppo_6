<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Models
use App\Models\Message;

class MessageController extends Controller
{
    
    public function newMessage(Request $request) 
    {

        $data = $request->all();
        $message = Message::create($data);

        // return response()->json($request->all());
        return response()->json([
            'success'=>true,
        ], 200);
    }
}
