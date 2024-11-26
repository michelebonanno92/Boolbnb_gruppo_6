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
							Indirizzo: {{ $apartment->address }}
						</li>
					</ul>

					<div>
						Servizi:
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
						</ul>
					</div>

					<div class="card-image">
						placeholder immagine
					</div>
					<div>
						Invia un messaggio placeholder
					</div>
					<div>
						<a href="{{ route('homepage.index') }}">Torna alla home</a>
					</div>
					
				</div>
			</div>
		</div>
	</div>

@endsection

        