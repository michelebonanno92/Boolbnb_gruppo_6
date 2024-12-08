<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\TomTomService;


//Helpers
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

// MODELS
use App\Models\ {
    Apartment,
    Message,
    Service,
    Sponsorship,
    User,
    View
};

class ApartmentController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //prendo l'utente autenticato
        $user = auth()->user();
        
        //prendo solo gli appartamenti con user_id corrispondente
        $apartments = Apartment::where('user_id', $user->id)->get();

        return view('admin.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::all();
        $sponsorships = Sponsorship::all();
        return view('admin.apartments.create', compact('services','sponsorships'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'services.required' => 'Devi selezionare almeno un servizio.',
        ];

        $data = $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:3|max:4096',
            'rooms' => 'required|min:1|max:20',
            'beds' => 'required|min:1|max:33',
            'toilets' => 'required|min:1|max:10',
            'square_meters' => 'required|min:1|max:300',
            'address' => 'required|min:3|max:255',
            'image' => 'nullable|image|max:2048',
            'services' => ['required', 'array', function ($attribute, $value, $fail) {
                if (count($value) < 1) {
                        $fail('Devi selezionare almeno un servizio.');
                    }
                }],
            'sponsorships' => 'nullable|array',
            // 'visible' => 'nullable|in:1,0,true,false',
        ], $messages);

        $coordinates = app(\App\Services\TomTomService::class)->searchAddress($data['address']);

        if (!$coordinates) {
            return back()->withErrors(['address' => 'Impossibile ottenere le coordinate per questo indirizzo.']);
        }

        // Aggiungi le coordinate ai dati
        $data['latitude'] = $coordinates['lat'];
        $data['longitude'] = $coordinates['lon'];

        $data['slug'] = str()->slug($data['title']);
        //verifico l'unicità dello slug
        $originalSlug = $data['slug'];
        $counter = 1;
        while (Apartment::where('slug', $data['slug'])->exists()) {
            $data['slug'] = "{$originalSlug}-{$counter}";
            $counter++;
        }

        //gestione immagini
        if (isset($data['image'])) {
            $imagePath = Storage::put('uploads', $data['image']);
           
            $data['image'] = $imagePath;
        }

        $data['visible'] = $request->boolean('visible');

        //salvo l'id dell'user che sta inserendo l'appartamento
        $data['user_id'] = auth()->id();

        // dd($data);
        
        $apartment = Apartment::create($data);

        $apartment->services()->sync($data['services'] ?? []);

        $apartment->sponsorships()->sync($data['sponsorships'] ?? []);


       


        return redirect()->route('admin.apartments.show', ['apartment' => $apartment->id]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Apartment $apartment)
    {
        if ($apartment->user_id !== auth()->id()) {
            abort(403, 'Non sei autorizzato a visualizzare questo appartamento.');
        }
        return view('admin.apartments.show', compact('apartment'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apartment $apartment)
    {

        if ($apartment->user_id !== auth()->id()) {
            abort(403, 'Non sei autorizzato a modificare questo appartamento.');
        }

        $services = Service::all();

        return view('admin.apartments.edit', compact('apartment', 'services'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Apartment $apartment)
    {
        $messages = [
            'services.required' => 'Devi selezionare almeno un servizio.',
        ];

        if ($apartment->user_id !== auth()->id()) {
            abort(403, 'Non sei autorizzato ad aggiornare questo appartamento.');
        }
        
        $data = $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:3|max:4096',
            'rooms' => 'required|min:1|max:20',
            'beds' => 'required|min:1|max:33',
            'toilets' => 'required|min:1|max:10',
            'square_meters' => 'required|min:1|max:300',
            'address' => 'required|min:3|max:255',
            'image' => 'nullable|image|max:2048',
            'services' => ['required', 'array', function ($attribute, $value, $fail) {
                if (count($value) < 1) {
                        $fail('Devi selezionare almeno un servizio.');
                    }
                }],
            // 'sponsorships' => 'nullable|array',

            // 'visible' => 'nullable|in:1,0,true,false',
        ], $messages);

        $data['slug'] = str()->slug($data['title']);
        // Verifica unicità dello slug se il titolo è stato modificato
        if ($apartment->title !== $data['title']) {
            $originalSlug = $data['slug'];
            $counter = 1;

            while (Apartment::where('slug', $data['slug'])->exists()) {
                $data['slug'] = "{$originalSlug}-{$counter}";
                $counter++;
            }
        }

        //immagini
        if (isset($data['image'])) {
            if ($apartment->image) {
                // elimina image(immagine) precedente
                Storage::delete($apartment->image);
                $apartment->image = null;
            }

            // altrimenti se è null aggiornalo e salvalo
            $imagePath = Storage::put('uploads', $data['image']);
            $data['image'] = $imagePath;
        }


        // $data['visible'] = isset($data['visible']);

        // if (isset($data['image'])) {
        //     $imagePath = Storage::put('uploads', $data['image']);
        //     $data['image'] = $imagePath;
        // }

        $data['visible'] = $request->boolean('visible');

        // dd($data);

        $apartment->update($data);

        $apartment->services()->sync($data['services'] ?? []);

        // $apartment->sponsorships()->sync($data['sponsorships'] ?? []);


        // $apartment->services()->sync($data['services'] ?? []);


        return redirect()->route('admin.apartments.show', ['apartment' => $apartment->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartment $apartment)
    {
        if ($apartment->user_id !== auth()->id()) {
            abort(403, 'Non sei autorizzato a eliminare questo appartamento.');
        }
        
        if ($apartment->image) {
            Storage::delete($apartment->image);
        }
        
        $apartment->delete();

        return redirect()->route('admin.apartments.index');
    }

    public function messages(Apartment $apartment)
    {
        // Controlla se l'utente è autorizzato a vedere i messaggi dell'appartamento
        if ($apartment->user_id !== auth()->id()) {
            abort(403, 'Non sei autorizzato a visualizzare i messaggi di questo appartamento.');
        }

        // Recupera i messaggi associati all'appartamento
        $messages = $apartment->messages()->latest()->get();

        return view('admin.apartments.messages', compact('apartment', 'messages'));
    }
}
