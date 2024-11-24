@extends('layouts.guest')

@section('main-content')
    <div class="row">
        {{-- <a href="{{route('Welcome') }}" class="btn btn-primary w-100">
            Tutti gli appartamenti
        </a> --}}
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-primary">
                        Welcome!
                    </h1>
                    <br>
                    La welcome page è una pagina pubblica (NON protetta)
                </div>
            </div>
        </div>

        <h1 style="text-align: center; margin: 20px;">Mappa Interattiva con Laravel 10</h1>
        <div id="map"></div>

        <!-- TomTom Maps SDK -->
        <script src="https://api.tomtom.com/maps-sdk-for-web/6.x/6.20.0/maps/maps-web.min.js"></script>
        <script>
            // La tua API Key di TomTom
            // const apiKey = "{{ config('services.tomtom.key') }}";
                // Usa l'API Key dal file di configurazione

            const apiKey = 'sZ2KDDgmueTdfLIOk79oabDnTIC0lcoS';

            // Inizializza la mappa
            const map = tt.map({
                key: apiKey,
                container: 'map', // ID del contenitore HTML
                center: [11.3492311, 44.4944456 ], // Coordinate iniziali (Amsterdam, ad esempio)
                zoom: 11
            });

            map.addControl(new tt.NavigationControl()); // Controlli di navigazione (zoom, rotazione, ecc.)

            // Recupera i dati dal backend Laravel
            fetch('api-points') // URL della tua API per i punti
                .then(response => response.json())
                .then(data => {
                    data.forEach(point => {
                        addMarker(point.lat, point.lon, point.name);
                    });
                })
                .catch(error => console.error('Errore durante il caricamento dei punti:', error));

            // Funzione per aggiungere un marker alla mappa
            function addMarker(lat, lon, name) {
                const popup = new tt.Popup({ offset: 30 }).setText(name);
                const marker = new tt.Marker()
                    .setLngLat([lon, lat])
                    .setPopup(popup) // Mostra il popup al clic
                    .addTo(map);
            }
        </script>

        <ul>
            @foreach ($apartments as $apartment)
            <li>
                {{ $apartment->title }}
            </li> 
            @endforeach
        </ul>
    </div>
@endsection
