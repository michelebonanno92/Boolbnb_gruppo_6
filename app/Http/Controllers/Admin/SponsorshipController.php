<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Braintree
use Braintree\Gateway;

// MODEL
use App\Models\{
    Sponsorship,
    Apartment,
    User
};

class SponsorshipController extends Controller
{
    
    //************************************* */
    public function index(Request $request, Gateway $gateway)
{
    $user = auth()->user();

    // Recupera gli appartamenti dell'utente
    $apartments = $user->apartments;

    // Recupera tutte le sponsorizzazioni
    $sponsorships = Sponsorship::all();

    // Genera il client token per il Drop-In di Braintree
    $clientToken = $gateway->clientToken()->generate();

    // Recupera l'ID dell'appartamento pre-selezionato, se presente
    $selectedApartmentId = $request->query('apartment_id', null);

    return view('admin.sponsorships.index', compact(
        'apartments', 
        'sponsorships', 
        'clientToken', 
        'selectedApartmentId'
    ));
}

public function store(Request $request, Gateway $gateway)
{
    $validated = $request->validate([
        'apartment_id' => 'required|exists:apartments,id',
        'sponsorship_id' => 'required|exists:sponsorships,id',
        'payment_method_nonce' => 'required|string',
    ]);

    // Recupera l'appartamento e verifica che appartenga all'utente autenticato
    $apartment = auth()->user()->apartments()->find($request->apartment_id);
    if (!$apartment) {
        return back()->withErrors(['apartment_id' => 'L\'appartamento selezionato non è valido.']);
    }

    // Recupera la sponsorizzazione
    $sponsorship = Sponsorship::findOrFail($request->sponsorship_id);

    // Avvia la transazione con Braintree
    try {
        $result = $gateway->transaction()->sale([
            'amount' => $sponsorship->price,
            'paymentMethodNonce' => $request->payment_method_nonce,
            'options' => ['submitForSettlement' => true],
        ]);
    } catch (\Exception $e) {
        return back()->withErrors(['payment' => 'Errore nel pagamento: ' . $e->getMessage()]);
    }

    // Verifica il risultato della transazione
    if ($result->success) {
        // Calcola il periodo di sponsorizzazione
        $startTime = now();
        $endTime = $startTime->copy()->addHours($sponsorship->duration_hours);

        // Associa la sponsorizzazione all'appartamento tramite la tabella pivot
        $apartment->sponsorships()->attach($sponsorship->id, [
            'start_time' => $startTime,
            'end_time' => $endTime,
        ]);

        return redirect()->route('admin.apartments.index')
            ->with('success', 'Appartamento sponsorizzato con successo!');
    } else {
        return back()->withErrors(['payment' => 'Errore nel pagamento: ' . $result->message]);
    }
}

}
