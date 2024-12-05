@extends('layouts.app')

@section('page-title', $apartment->slug )

@section('main-content')

	<div class="container  text-center">
		<div class="row ">
			<div class="col-12 col-md-6 offset-md-3">
				<div class="card p-4">
					<div>
						@if ($apartment->image)
						  <img src="{{ '/storage/'.$apartment->image }}" alt="{{ $apartment->title }}" class="img-fluid rounded">
						@endif
					</div>
					<h4 class="mt-4">
						{{ $apartment->title }}
					</h4>
					<div class="mb-3">
						@if ($apartment->visible)
							<div class="badge text-bg-success">
								Pubblicato
							</div>

						@else
							<div class="badge text-bg-warning">
								Non pubblicato
							</div>
						@endif
					</div>
					<p>
						{{ $apartment->address }}
					</p>
					<p>
						{{ $apartment->description }}
					</p>
					<ul class="text-start">
						<li>
							Stanze: {{ $apartment->rooms }}
						</li>
						<li>
							Letti: {{ $apartment->beds }}
						</li>
						<li>
							Bagni: {{ $apartment->toilets }}
						</li>
					</ul>

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
                        center: [{{$apartment->longitude}}, {{$apartment->latitude}}], // Coordinate iniziali (Amsterdam, ad esempio)
                        zoom: 14
                    });

                    map.addControl(new tt.NavigationControl()); // Controlli di navigazione (zoom, rotazione, ecc.)

                    // // Recupera i dati dal backend Laravel
                    // fetch('api-points') // URL della tua API per i punti
                    //     .then(response => response.json())
                    //     .then(data => {
                    //         data.forEach(point => {
                    //             addMarker(point.lat, point.lon, point.name);
                    //         });
                    //     })
                    //     .catch(error => console.error('Errore durante il caricamento dei punti:', error));

					addMarker({{$apartment->latitude}}, {{$apartment->longitude}}, '{{$apartment->title}}')

                    // Funzione per aggiungere un marker alla mappa
                    function addMarker(lat, lon, name) {
                        const popup = new tt.Popup({ offset: 30 }).setText(name);
                        const marker = new tt.Marker()
                            .setLngLat([lon, lat])
                            .setPopup(popup) // Mostra il popup al clic
                            .addTo(map);
                    }
                </script>

					<div class="text-start">
						<span class="mb-2">Servizi:</span>
						<ul>
							@foreach ($apartment->services as $service)
								<li  class="badge my-services text-bg-primary rounded-pill">
									{{ $service->service_name }}
								</li>
                        	@endforeach
						</ul>
					</div>

					<div class="row">
						<div class="d-flex justify-content-between">
							<div class="d-inline-block me-3">
								<a href="{{ route('admin.apartments.index') }}" class="btn btn-outline-success mb-4"><- Indietro</a>
							</div>

							<div class="d-inline-block me-3">
								<a href="{{ route('admin.apartments.edit', ['apartment' => $apartment->id ]) }}"  class="btn btn-outline-warning mb-4">Modifica</a>
							</div>
							
							<form 
								onsubmit="return confirm('Sei sicuro di voler cancellare questo appartamento?')"
								action="{{ route('admin.apartments.destroy', ['apartment' => $apartment->id]) }}" 
								method="POST" 
								class="d-inline-block">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger">
									Elimina
								</button>
							</form>

							<div class="d-inline-block me-3">
								<a href="{{ route('admin.sponsorships.index', ['apartment_id' => $apartment->id]) }}"  class="btn btn-outline-primary mb-4">Sponsorizza</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection

