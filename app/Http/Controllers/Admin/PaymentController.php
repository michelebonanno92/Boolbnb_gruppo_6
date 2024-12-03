<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Apartment;
use Illuminate\Http\Request;
use Braintree\Gateway;

class PaymentController extends Controller
{

    public function store(Request $request)
    {
        $gateway = new Gateway([
            'environment' => env('BRAINTREE_ENV'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY')
        ]);

        // Recupera i dati dal form
        $nonce = $request->input('payment_method_nonce');
        $amount = $request->input('amount');
        $apartmentId = $request->input('apartment_id');
        $package = $request->input('package');

        // Crea la transazione con il nonce
        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
            'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            // Logica per aggiornare la sponsorizzazione dell'appartamento
            $apartment = Apartment::find($apartmentId);
            $apartment->sponsored = true;
            $apartment->sponsored_until = now()->addHours($this->getPackageDuration($package));
            $apartment->save();

            return redirect()->route('admin.apartments.index')->with('success', 'Appartamento sponsorizzato con successo!');
        } else {
            return back()->withErrors(['payment' => 'Errore nel pagamento: ' . $result->message]);
        }
    }

    private function getPackageDuration($package)
    {
        // Restituisci la durata in ore in base al pacchetto selezionato
        switch ($package) {
            case '24h':
                return 24;
            case '72h':
                return 72;
            case '144h':
                return 144;
            default:
                return 24; // Default in caso di errore
        }
    }

}
