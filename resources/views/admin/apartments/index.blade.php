@extends('layouts.app')

@section('page-title', 'Appartamenti')

@section('main-content')
    

    <div class="container">
        <div class="d-flex justify-content-center pb-4">
            <h1>I miei appartamenti</h1>
        </div>
        
        <div class="container">
            <div class="row">
                <div class="col-6 col-md-4">
                    <div>
                        <a href="{{ route('admin.apartments.create') }}" class="btn btn-success my-4 w-100">Nuovo appartamento</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container mb-4">
            <div class="row">
                @forelse ($apartments as $apartment)
                
                <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                    <div class="card my-card p-3">
                        <div class="text-center">
                            @if ($apartment->image)
                            <img src="{{ '/storage/'.$apartment->image }}" alt="{{ $apartment->title }}" class="my-img rounded">
                            @endif
                      </div>
                        <h4 class="mb-2">
                            {{ $apartment->title }}
                        </h4>
                        <ul class="my-list">
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
                    
                        <div class="mt-4">
                            <ul class="service-list">
                                @foreach ($apartment->services as $service)
                                    <li class="badge text-bg-primary my-services rounded-pill">
                                        {{ $service->service_name }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div>
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

                        <a href="{{ route('admin.apartments.show', $apartment->id) }}" class="btn btn-primary my-4">Dettagli</a>

                    </div>
                </div>
            
                @empty
                    <h2>
                        Inserisci il tuo primo appartamento!

                    </h2>
                @endforelse

            </div>
        </div>
        
    </div>
    
    

@endsection
