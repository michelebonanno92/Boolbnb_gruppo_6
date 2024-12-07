@extends('layouts.app')

@section('page-title' , 'Crea Appartamento')

@section('main-content')


<div class="container">
	<div class="row">
		<div class="col-12 col-md-6 offset-md-3">
			{{-- <h1>
				Crea Appartamento
			</h1> --}}
			
			<div class="mb-3">
			<span class="text-danger">*</span>Campi obbligatori
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-12 col-md-6 offset-md-3">
			<div class="card form-card p-4">
				<form  action="{{ route('admin.apartments.store')}}" method="POST" enctype="multipart/form-data" >
						@csrf
				
						<div class="mb-3">
							<label for="title" class="form-label fw-bold">Titolo<span class="text-danger">*</span></label></label>
							<input type="text" class="form-control" id="title"  name="title" placeholder="Inserisci il nome dell'appartamento..." value="{{old('title')}}" required minlength="3" maxlength="255">
							@error('title')
								<div class="alert alert-danger mt-2">
								Errore Titolo: {{ $message }}
								</div>
							@enderror
						</div>

						<div class="mb-3">
							<label for="image" class="form-label fw-bold">Immagine
							<input type="file" class="form-control" id="image"  name="image" >
							@error('image')
								<div class="alert alert-danger mt-2">
									Errore immagine: {{ $message }}
								</div>
							@enderror
						</div>
				
						<div class="mb-3">
							<label for="description" class="form-label fw-bold">Descrizione<span class="text-danger">*</span></label></label>
							<textarea  class="form-control" id="description"  name="description" placeholder="Inserisci una breve descrizione dell'appartamento..." required minlength="3" maxlength="4096" cols="10" rows="3">{{old('description')}}</textarea>
							@error('description')
								<div class="alert alert-danger mt-2">
									Errore Descrizione: {{ $message }}
								</div>
							@enderror
						</div>
				
						<div class="mb-3">
							<label for="rooms" class="form-label fw-bold">Numero stanze<span class="text-danger">*</span></label>
							<input type="number" class="form-control" id="rooms"  name="rooms" placeholder="Inserisci il numero delle stanze..." value="{{old('rooms')}}" required  min="1" max="20">
							@error('rooms')
								<div class="alert alert-danger mt-2">
									Errore Stanze: {{ $message }}
								</div>
							@enderror
						</div>
				
						<div class="mb-3">
							<label for="beds" class="form-label fw-bold">Numero letti<span class="text-danger">*</span></label>
							<input type="number" class="form-control" id="beds"  name="beds" placeholder="Inserisci il numero dei letti..." value="{{old('beds')}}" required  min="1" max="33">
							@error('beds')
								<div class="alert alert-danger mt-2">
									Errore Letti: {{ $message }}
								</div>
							@enderror
						</div>
				
						<div class="mb-3">
							<label for="toilets" class="form-label fw-bold">Numero bagni<span class="text-danger">*</span></label>
							<input type="number" class="form-control" id="toilets"  name="toilets" placeholder="Inserisci il numero dei bagni..." value="{{old('toilets')}}" required  min="1" max="10">
							@error('toilets')
								<div class="alert alert-danger mt-2">
									Errore Bagni: {{ $message }}
								</div>
							@enderror
						</div>
				
						<div class="mb-3">
							<label for="square_meters" class="form-label fw-bold">Numero metri quadri<span class="text-danger">*</span></label>
							<input type="number" class="form-control" id="square_meters"  name="square_meters" placeholder="Inserisci il numero dei metri quadri..." value="{{old('square_meters')}}" required  min="20" max="300">
							@error('square_meters')
								<div class="alert alert-danger mt-2">
									Errore metri quadri: {{ $message }}
								</div>
							@enderror
						</div>

						<div class="mb-3">
							<label for="search-input" class="form-label fw-bold">Cerca Indirizzo<span class="text-danger">*</span></label>
							<input 
								autocomplete="off"
								type="text"
								id="search-input"
								name="address"
								placeholder="Cerca un indirizzo..."
								class="form-control"
								oninput="fetchSuggestions()"
							/>
							<ul id="suggestions-list" class="list-group mt-2"></ul>
							@error('address')
								<div class="alert alert-danger mt-2">
									Errore Indirizzo: {{ $message }}
								</div>
							@enderror
						</div>
				
						{{-- <div class="mb-3">
							<label for="address" class="form-label fw-bold">Indirizzo<span class="text-danger">*</span></label>
							<input type="text" class="form-control" id="address"  name="address" placeholder="Inserisci l'indirizzo..." value="{{old('address')}}" required minlength="10" maxlength="255">
							@error('address')
								<div class="alert alert-danger mt-2">
									Errore Indirizzo: {{ $message }}
								</div>
							@enderror
						</div> --}}
						{{-- servizi --}}
						<div class="card my-services p-4 mb-3">
							<div>
								<p class="form-label fw-bold">Servizi:</p>
							</div>
							@foreach ($services as $service)
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="service-{{ $service->id }}" name="services[]" value="{{ $service->id }}">
									<label class="form-check-label" for="service-{{ $service->id }}">
										{{ $service->service_name }}
									</label>
								</div>
							@endforeach
							@error('services')
								<div class="alert alert-danger mt-2">
									{{ $message }}
								</div>
							@enderror
						
						</div>
				
						<div class="mb-3">
						<div class="mb-3">
							<div class="form-check">
								<input class="form-check-input" type="radio" name="visible" id="visible" value="true">
								<label class="form-check-label" for="visible">
									Pubblica
								</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="visible" id="not-visible" value="false">
								<label class="form-check-label" for="not-visible">
									Nascondi
								</label>
							</div>
					    </div>
						</div>
				
					
						<button type="submit" class="btn btn-primary">
							+ Aggiungi
						</button>
					</form>
			</div>
		</div>
	</div>
</div>


<script>
    const input = document.getElementById('search-input');
    const suggestionsList = document.getElementById('suggestions-list');
    const apiKey = 'KtAYjlAUfMLakTMNV7iootfwwERDicp1'; // Inserisci qui la tua chiave API di TomTom

	

    function fetchSuggestions() {
        const query = input.value.trim();

        if (query.length < 1) {
            suggestionsList.innerHTML = ''; // Pulisci i suggerimenti se la query è troppo breve
            return;
        }

        // URL dell'API di autocompletamento di TomTom
        const url = `https://api.tomtom.com/search/2/search/${encodeURIComponent(query)}.json?key=${apiKey}&typeahead=true&limit=5`;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                suggestionsList.innerHTML = ''; // Pulisci i suggerimenti

                const results = data.results || [];
                results.forEach(result => {
                    const address = result.address.freeformAddress;
                    const li = document.createElement('li');
                    li.classList.add('list-group-item', 'list-group-item-action');
                    li.textContent = address;
                    li.onclick = () => selectSuggestion(address, result.position);
                    suggestionsList.appendChild(li);
                });
            })
            .catch(error => {
                console.error('Errore nella ricerca:', error);
            });
    }

    function selectSuggestion(address, position) {
        input.value = address; // Imposta l'indirizzo selezionato nell'input
        suggestionsList.innerHTML = ''; // Pulisci i suggerimenti
        console.log('Selezionato:', address, 'Coordinate:', position);
        // Puoi salvare o usare position per ulteriori operazioni (es. salvataggio nel form)
    }

	document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const input = document.getElementById('search-input'); // Selezioniamo tutti gli input e textarea

        // Blocco dell'evento Enter sul form e sugli input
        form.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();  // Previene l'invio tramite Enter
                console.log('Invio con Enter bloccato');
            }
        });

		// Blocco dell'evento Enter sul form e sugli input
        input.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();  // Previene l'invio tramite Enter
                console.log('Invio con Enter bloccato');
            }
        });
    });
</script>

@endsection
