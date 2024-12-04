<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Braintree
use Braintree\Gateway;

// MODEL
use App\Models\{
    Sponsorship,
    Apartment
};

class SponsorshipController extends Controller
{
    // public function index(Gateway $gateway)
    // {
    //     $user = Auth()->user();
    //     $apartments = $user->apartments; // Assuming the user has apartments
    //     $clientToken = $gateway->clientToken()->generate();

    //     return view('admin.sponsorships.index', compact('apartments', 'clientToken'));
    // }

    // public function store(Request $request, Gateway $gateway)
    // {
    //     // dd($request);
    //     $validate = $request->validate([
    //         'apartment_id' => 'required|exists:apartments,id',
    //         'package' => 'required|in:24h,72h,144h',
    //         'payment_method_nonce' => 'required|string',
    //     ]);
    //     // \Log::info('Nonce ricevuto:', ['nonce' => $request->payment_method_nonce]);

    //     $prices = ['24h' => 2.99, '72h' => 5.99, '144h' => 9.99];
    //     $price = $prices[$request->package];

    //     $result = $gateway->transaction()->sale([
    //         'amount' => $price,
    //         'paymentMethodNonce' => $request->payment_method_nonce,
    //         'options' => ['submitForSettlement' => true],
    //     ]);

    //     if ($result->success) {
    //         // $startTime = now();
    //         // $endTime = $startTime->copy()->addHours((int)str_replace('h', '', $request->package));

    //         Sponsorship::create([
    //             'apartment_id' => $request->apartment_id,
    //             'package' => $request->package,
    //             'price' => $price,
    //             // 'start_time' => $startTime,
    //             // 'end_time' => $endTime,
    //         ]);

    //         return redirect()->route('admin.sponsorships.index')->with('success', 'Sponsorship created successfully!');
    //     } else {
    //         return back()->withErrors(['payment' => 'Payment failed. Please try again.']);
    //     }

    
    // }


    public function index(Gateway $gateway)
    {
        $user = auth()->user();
        $apartments = $user->apartments;
        $sponsorships = Sponsorship::all();
        $clientToken = $gateway->clientToken()->generate();

        return view('admin.sponsorships.index', compact('apartments', 'sponsorships', 'clientToken'));
    }

    public function store(Request $request, Gateway $gateway)
    {
        $validated = $request->validate([
            'apartment_id' => 'required|exists:apartments,id',
            'sponsorship_id' => 'required|exists:sponsorships,id',
            'payment_method_nonce' => 'required|string',
        ]);

        $sponsorship = Sponsorship::findOrFail($request->sponsorship_id);
        $apartment = Apartment::findOrFail($request->apartment_id);

        $result = $gateway->transaction()->sale([
            'amount' => $sponsorship->price,
            'paymentMethodNonce' => $request->payment_method_nonce,
            'options' => ['submitForSettlement' => true],
        ]);

        if ($result->success) {
            $startTime = now();
            $endTime = $startTime->addHours($sponsorship->duration_hours);

            $apartment->sponsorships()->attach($sponsorship->id, [
                'start_time' => $startTime,
                'end_time' => $endTime,
            ]);

            return redirect()->route('admin.sponsorships.index')->with('success', 'Appartamento sponsorizzato con successo!');
        } else {
            return back()->withErrors(['payment' => 'Errore nel pagamento: ' . $result->message]);
        }
    }

    // public function create(Request $request, Gateway $gateway)
    // {
    //     $clientToken = $gateway->clientToken()->generate();

    //     return view('admin.sponsorships.index', compact('clientToken'));
    // }
}
