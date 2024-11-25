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
                        <a href="{{ route('admin.apartments.create') }}" class="btn btn-success my-4">Nuovo appartamento</a>
                         <!-- link ai servizi -->
                         <a href="{{ route('admin.services.index') }}" class="btn btn-primary my-4">Elenco servizi</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container mb-4">
            <div class="row">
                
                @foreach ($apartments as $apartment)
            
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <div class="card my-card py-1 px-3">
                            <div>
                                @if ($apartment->image)
                                  <img src="{{ '/storage/'.$apartment->image }}" alt="{{ $apartment->title }}" style="height: 100px">
                                @endif
                            </div>
                            <img src="{{ $apartment->image }}" alt="Immagine {{ $apartment->title }}">
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

                            <a href="{{ route('admin.apartments.show', $apartment->id) }}" class="btn btn-primary my-4">Dettagli</a>

                        </div>
                    </div>
            
                @endforeach
            

            </div>
        </div>
        
    </div>
    
    

@endsection

<!-- <div class="card mb-4 d-flex flex-column flex-grow-1 justify-content-between">
                            <img src="{{ $apartment->image }}" class="card-img-top" alt="{{ $apartment->title }}">
                            <div class="card-body">
                            <h3 class="card-title">{{ $apartment->title }}</h3>
                            <p class="card-text">{{ $apartment->address }}</p>
                            <a href="{{ route('admin.apartments.show', ['apartment' => $apartment->id]) }}" class="btn btn-primary">Visualizza appartamento</a>
                            </div>
                        </div> -->