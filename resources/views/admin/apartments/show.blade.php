@extends('layouts.app')

@section('page-title','BoolBnb '.$apartment->slug )

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
					<div class="mb-2">
						@if($apartment->sponsorships->count())
							@if($apartment->sponsorships->count() > 1)
								<i class="fa-solid fa-bolt text-warning"></i>
								<strong class="fs-4">
									{{ $apartment->sponsorships->sum('duration_hours') }}
								</strong>
								<strong class="fs-4">ore</strong>
							@else
								<i class="fa-solid fa-bolt text-warning"></i>
								<strong class="fs-4">{{ $apartment->sponsorships->first()->duration_hours }}</strong>
								<span class="fs-4">ore</span>
							@endif
						@endif
					</div>
					<div>
						<a href="{{ route('admin.sponsorships.index', ['apartment_id' => $apartment->id]) }}"  class="btn btn-outline-primary fs-4 fw-semibold w-100 mb-4">
							Sponsorizza
						</a>
					</div>
					<p>
						{{ $apartment->address }}
					</p>
					<p class="text-start">
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

					<div class="text-start mb-2">
						<ul class="p-0">
							@foreach ($apartment->services as $service)
								<li class="badge text-dark my-services fs-6 me-2 p-0">
									{{ $service->service_name }}
								</li>
                        	@endforeach
						</ul>
					</div>

					<div class="row">
						<div class="d-flex">
							<div class="d-inline-block me-3">
								<a href="{{ route('admin.apartments.index') }}" class="btn btn-outline-secondary mb-4">Indietro</a>
							</div>

							<div class="d-inline-block me-3">
								<a href="{{ route('admin.apartments.edit', ['apartment' => $apartment->id ]) }}"  class="btn btn-outline-warning mb-4">Modifica</a>
							</div>
							
							<form 
								onsubmit="return confirm('Sei sicuro di voler cancellare questo appartamento?')"
								action="{{ route('admin.apartments.destroy', ['apartment' => $apartment->id]) }}" 
								method="POST" 
								class="d-inline-block ms-auto">
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
		</div>
	</div>

@endsection

