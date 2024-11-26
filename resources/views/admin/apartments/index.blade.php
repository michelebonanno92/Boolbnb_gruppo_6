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
                            <div class="card my-card py-1 px-3">
                                <div>
                                    @if ($apartment->image)
                                      <img src="{{ '/storage/'.$apartment->image }}" alt="{{ $apartment->title }}" style="height: 100px">
                                    @endif
                                </div>
                                <h4 class="mt-4">
                                    {{ $apartment->title }}
                                </h4>
                                <p>
                                    {{ $apartment->description }}
                                </p>
                                <li>
                                    Stanze: {{ $apartment->rooms }}
                                </li>
                                <li>
                                    Letti: {{ $apartment->beds }}
                                </li>
                                <li>
                                    Bagni: {{ $apartment->toilets }}
                                </li>
                               
                                <div class="mt-4">
                                    Servizi:
                                    <ul>
                                        lista servizi 
                                    </ul>
                                </div>

                                <a href="{{ route('admin.apartments.show', $apartment->id) }}" class="btn btn-primary my-4">Dettagli</a>

                            </div>
                        </div>
            
                @empty
                    <h2>
                        Non hai ancora inserito appartamenti.

                    </h2>
                @endforelse

            </div>
        </div>
        
    </div>
    
    

@endsection
