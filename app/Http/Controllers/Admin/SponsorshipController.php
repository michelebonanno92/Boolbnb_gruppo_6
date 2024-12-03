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
    public function index(Gateway $gateway)
    {
        $user = Auth()->user();
        $apartments = $user->apartments; // Assuming the user has apartments
        $clientToken = $gateway->clientToken()->generate();

        return view('admin.sponsorships.index', compact('apartments', 'clientToken'));
    }

    public function store(Request $request, Gateway $gateway)
    {
        // dd($request);
        $validate = $request->validate([
            'apartment_id' => 'required|exists:apartments,id',
            'package' => 'required|in:24h,72h,144h',
            'payment_method_nonce' => 'required|string',
        ]);
        // \Log::info('Nonce ricevuto:', ['nonce' => $request->payment_method_nonce]);

        $prices = ['24h' => 2.99, '72h' => 5.99, '144h' => 9.99];
        $price = $prices[$request->package];

        $result = $gateway->transaction()->sale([
            'amount' => $price,
            'paymentMethodNonce' => $request->payment_method_nonce,
            'options' => ['submitForSettlement' => true],
        ]);

        if ($result->success) {
            // $startTime = now();
            // $endTime = $startTime->copy()->addHours((int)str_replace('h', '', $request->package));

            Sponsorship::create([
                'apartment_id' => $request->apartment_id,
                'package' => $request->package,
                'price' => $price,
                // 'start_time' => $startTime,
                // 'end_time' => $endTime,
            ]);

            return redirect()->route('admin.sponsorships.index')->with('success', 'Sponsorship created successfully!');
        } else {
            return back()->withErrors(['payment' => 'Payment failed. Please try again.']);
        }

    
    }

    // public function create(Request $request, Gateway $gateway)
    // {
    //     $clientToken = $gateway->clientToken()->generate();

    //     return view('admin.sponsorships.index', compact('clientToken'));
    // }
}
