@extends('layouts.app')

@section('page-title', $apartment->slug )

@section('main-content')

	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="card py-2 px-4">
					<h4>
						{{ $apartment->title }}
					</h4>
					<p>
						{{ $apartment->description }}
					</p>
					<ul>
						<li>
							Stanze: {{ $apartment->rooms }}
						</li>
						<li>
							Letti: {{ $apartment->beds }}
						</li>
						<li>
							Bagni: {{ $apartment->toilets }}
						</li>
						<li>
							Indirizzo: {{ $apartment->address }}
						</li>
					</ul>

					<div>
						Servizi:
						<ul>
							<li>
								placeholder servizi
							</li>
						</ul>
					</div>

					<div class="card-image">
						placeholder immagine
					</div>

					<div>
						<a href="{{ route('admin.apartments.edit', ['apartment' => $apartment->id ]) }}">Modifica</a>
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
				</div>
			</div>
		</div>
	</div>

@endsection

<!-- <div class="card w-100 mb-3 text-center">
	<div class="card-body">

		<div class="col-12 d-flex align-content-between">
			<div class="card mb-4 card-apartment  ">
			<img src="{{ $apartment->image }}" class="card-img-top" alt="{{ $apartment->title }}">
			<div class="card-body">
				<h3 class="card-title">{{ $apartment->title }}</h3>
				<p class="card-text">{{ $apartment->address }}</p>
				<div class="row">
				<div class="col-3">
					<h4>Stanze</h4>
					<h5>{{ $apartment->rooms }}</h5>
				</div>
				<div class="col-3">
					<h4>Letti</h4>
					<h5>{{ $apartment->beds }}</h5>
				</div>
				<div class="col-3">
					<h4>Bagni</h4>
					<h5>{{ $apartment->toilets }}</h5>
				</div>
				<div class="col-3">
					<h4>Metri quadri</h4>
					<h5>{{ $apartment->square_meters }}</h5>
				</div>
				</div>
				@if ( $apartment->visible == 1)
				<div>
					<p class="text-success">Visibile</p>
				</div>
				@else
				<div>
					<p class="text-danger">Non Visibile</p>
				</div>
				@endif

				{{-- //messaggi --}}
				{{-- <div>
				<a href="message" class="btn btn-success">Messaggi</a>
				</div> --}}
			</div>
			</div>
		</div>


	</div>
</div> -->

        <!-- <a href="{{ route('admin.apartments.edit', ['apartment' => $apartment->id]) }}" class="btn btn-warning">Modifica</a> -->
        