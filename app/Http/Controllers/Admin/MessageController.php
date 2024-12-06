<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// MODELS
use App\Models\ {
    Apartment,
    Message,
    User
};
class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //prendo l'utente autenticato
        $user = auth()->user();

        $apartments = Apartment::where('user_id', $user->id)->get();
        
        $messages = Message::whereIn('apartment_id', $apartments->pluck('id'))->with('apartment')->get();

        // $messages = Message::where('apartment_id', $user->id)->get();
        if ($apartments->count()) {

            return view('admin.messages.index', compact('messages','apartments'));

        }
        else {
            return view('admin.messages.index');

        }
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
    public function show(Message $message, Apartment $apartment)
    {
        // if ($apartment->user_id !== auth()->id()) {
        //     abort(403, 'Non sei autorizzato a visualizzare i messaggi di questo appartamento.');
        // }
        // $user = auth()->user();

        // $apartments = Apartment::where('user_id', $user->id)->get();

        // // $apartments = Apartment::where('apartment_id', $apartments->id)->get();
        // $messages = Message::whereIn('apartment_id', $apartments->pluck('id'))->with('apartment')->get();

        return view('admin.messages.show', compact('message', 'apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }
}
