<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
use App\Models\Message;

class MessageController extends Controller
{
    /**
     * Store a new message.
     */
    public function sendMessage(Request $request)
    {
        // dd($request->all());
        // Validazione dei dati in arrivo
        $validatedData = $request->validate([
            'name' => 'required|string|max:64',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:2000',
            // 'apartment_slug' => 'required|string|exists:apartments,slug',
        ]);

        // Trova l'appartamento tramite lo slug
        $apartment = Apartment::where('slug', $validatedData['apartment_slug'])->first();

        // Crea un nuovo messaggio
        $message = new Message();
        $message->name = $validatedData['name'];
        $message->email = $validatedData['email'];
        $message->message = $validatedData['message'];
        $message->save();

        // Aggiorna il contatore dei messaggi dell'appartamento
        $apartment->increment('messages');

        return response()->json([
            'success' => true,
            'message' => 'Messaggio inviato con successo.',
        ]);
    }
}