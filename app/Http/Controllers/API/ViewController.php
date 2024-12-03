<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\View;
use Illuminate\Http\Request;

class ViewController extends Controller
{

    public function recordView(Request $request)
    {
        $apartmentId = $request->input('apartment_id');
        $ipAddress = $request->input('ip_address');

        // Verifica se l'IP ha già registrato una visualizzazione per questo appartamento
        $existingView = View::where('apartment_id', $apartmentId)
                            ->where('ip_address', $ipAddress)
                            ->exists();

        if (!$existingView) {
            // Registra la visualizzazione
            View::create([
                'apartment_id' => $apartmentId,
                'ip_address' => $ipAddress,
                'view_date' => now(), // Usa la data e ora corrente
            ]);
        }

        return response()->json(['message' => 'Visualizzazione registrata']);
    }


}
