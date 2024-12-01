<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\Apartment;
use App\Models\Message;

class MessageController extends Controller
{
    /**
     * Store a new message.
     */
    public function sendMessage(Request $request)
    {
        // // dd($request->all());
        // // Validazione dei dati in arrivo
        // // $validatedData = $request->validate([
        // //     'name' => 'required|string|max:64',
        // //     'email' => 'required|email|max:255',
        // //     'message' => 'required|string|max:2000',
        // //     // 'apartment_slug' => 'required|string|exists:apartments,slug',
        // // ]);

        // $validatedData = $request;

        // // Trova l'appartamento tramite lo slug
        // // $apartment = Apartment::where('slug', $validatedData['apartment_slug'])->first();
        // // $apartment = Apartment::get();

        // // Crea un nuovo messaggio
        // $message = new Message();
        // $message->name = $validatedData['name'];
        // $message->email = $validatedData['email'];
        // $message->message = $validatedData['message'];
        // $message->save();

        // // Aggiorna il contatore dei messaggi dell'appartamento
        // // $apartment->increment('messages');

        // return response()->json([
        //     'success' => true,
        //     'message' => 'Messaggio inviato con successo.',
        // ]);


        // Validazione dei dati in arrivo
        // $validatedData = $request->validate([
        //     'name' => 'required|string|max:64',
        //     'email' => 'required|email|max:255',
        //     'message' => 'required|string|max:2000',
        // ]);

        // dd($request->all());

        // $validatedData = $request;

          // Validazione dei dati
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:64',
                'email' => 'required|email|max:255',
                'message' => 'required|string|max:2000',  // Corretto 'text' in 'string'
                'apartment_id' => 'nullable|integer|exists:apartments,id',
            ]);
        } catch (ValidationException $e) {
            // Gestisci l'errore di validazione
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),  // Mostra gli errori di validazione
            ], 422);
        }

        // Creazione del messaggio
        $message = Message::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'message' => $validatedData['message'],
            'apartment_id' => $validatedData['apartment_id']
        ]);

        // Risposta JSON
        return response()->json([
            'success' => true,
            'message' => 'Messaggio inviato con successo.',
            'data' => [
                'message_id' => $message->id,
                'name' => $message->name,
                'email' => $message->email,
                'created_at' => $message->created_at,
                // 'apartment_id' => $message->apartment_id
            ],
        ]);

        
    }
}