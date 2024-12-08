@extends('layouts.app')

@section('page-title','BoolBnb '.$apartment->slug )

@section('main-content')

	<div class="container  text-center">
		<div class="row ">
			<div class="col-12 col-md-8 offset-md-2">
				<div class="p-4">
					<div class="col-12 col-md-6 offset-md-3">
						@if ($apartment->image)
						  <img src="{{ '/storage/'.$apartment->image }}" alt="{{ $apartment->title }}" class="img-fluid rounded">
						{{-- @else
						  <img src="#" alt="da caricare" class="my-img rounded"> --}}
						@endif
					</div>
					<h4 class="mt-4 ">
						{{ $apartment->title }}
					</h4>

					<div class="d-flex justify-content-center align-items-center my-2">
						<div class="me-3 py-2">
							@if ($apartment->visible)
		
								<i class="fa-solid text-success fa-2x fa-eye"></i>
	
							@else
	
								<i class="fa-solid text-danger fa-2x fa-eye-slash"></i>
	
							@endif

						</div>
						<div>
							@if($apartment->sponsorships->count())
								<div>
									@if($apartment->sponsorships->count() > 1)
										<i class="fa-solid fa-bolt fa-2x text-warning"></i>
										<strong class="fs-4 me-1">
											{{ $apartment->sponsorships->sum('duration_hours') }}
										</strong>
										<strong class="fs-4">ore</strong>
									@else
										<i class="fa-solid fa-bolt fa-2x text-warning"></i>
										<strong class="fs-4 me-1">{{ $apartment->sponsorships->first()->duration_hours }}</strong>
										<strong class="fs-4">ore</strong>
									@endif
								</div>
							@endif
							
						</div>

					</div>
					
					{{-- <div class="mb-2">
					</div> --}}
					<div>
						<a href="{{ route('admin.sponsorships.index', ['apartment_id' => $apartment->id]) }}"  class="btn btn-outline-primary fs-4 fw-semibold w-100 mb-4">
							Sponsorizza
						</a>
					</div>
					<p>
						<i class="fa-solid fa-location-dot text-danger"></i>
						{{ $apartment->address }}
					</p>
					<p class="text-start text-secondary fw-bold">
						{{ $apartment->description }}
					</p>
					<ul class="text-start">
						<li>
							Stanze: <span class="fw-bold">{{ $apartment->rooms }}</span>
						</li>
						<li>
							Letti: <span class="fw-bold">{{ $apartment->beds }}</span>
						</li>
						<li>
							Bagni: <span class="fw-bold">{{ $apartment->toilets }}</span>
						</li>
					</ul>

					<div class="text-start mb-2">
						<h3>I tuoi servizi:</h3>
						<ul class="p-0">
							@foreach ($apartment->services as $service)
								<li class="text-secondary my-services fs-6 me-2 p-0 fw-bold ">
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
								<a href="{{ route('admin.apartments.edit', ['apartment' => $apartment->id ]) }}"  class="btn btn-outline-primary mb-4">Modifica</a>
							</div>

							<div class="d-inline-block me-3">
								<a href="{{ route('admin.apartments.messages', ['apartment' => $apartment->id ]) }}"  class="btn btn-outline-primary mb-4">Messaggi</a>
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

