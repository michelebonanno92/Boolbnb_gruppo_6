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

