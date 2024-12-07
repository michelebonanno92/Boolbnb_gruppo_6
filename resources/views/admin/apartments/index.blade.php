@extends('layouts.app')

@section('page-title', 'BoolBnb Appartamenti')

@section('main-content')
    

    <div class="container ">
        <div class="d-flex justify-content-center  pb-4">
            <h1 class="fw-bold">I Tuoi Appartamenti e Casette </h1>
        </div>
        
        <div class="container">
            <div class="row">
                <div class="col-6 col-md-4">
                    <div>
                        <a href="{{ route('admin.apartments.create') }}" class="btn btn-outline-primary my-4 w-100">Nuovo appartamento</a>
                    </div>
                </div>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-primary">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">{{ implode('', $errors->all(':message')) }}</div>
        @endif
        <div class="container mb-4">
            <div class="row">
                @forelse ($apartments as $apartment)
                
                <div class="col-12 col-lg-6 p-0 mb-3 d-flex">
                    <div class="container">

                        <div class="card my-card p-3">
                            <h4 class="mb-3 py-3 text-center">
                                {{ $apartment->title }}
                            </h4>
                            <div class="text-center my-img-container">
                                @if ($apartment->image)
                                    <img src="{{ '/storage/'.$apartment->image }}" alt="{{ $apartment->title }}" class="my-img rounded">
                                @else
                                <img src="#" alt="da caricare" class="my-img rounded">
                                @endif
                            </div>
                            <ul class="my-list ">
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
                            
                            <div class="hour-sponsorship">
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
                            <div class="mt-4 flex-grow-1">
                                <ul class="service-list mt-2 ">
                                    @foreach ($apartment->services as $service)
                                        <li class="fw-bold text-secondary me-3 p-0 my-services fs-6">
                                            {{ $service->service_name }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="container align-items-end">
                                @if ($apartment->visible)
                                    <div class="badge text-bg-primary">
                                        Pubblicato
                                    </div>
    
                                @else
                                    <div class="badge text-bg-success">
                                        Non pubblicato
                                    </div>
                                @endif
                            </div>
    
                            <div class="btn-container">
                                <a href="{{ route('admin.apartments.show', $apartment->id) }}" class="btn btn-warning my-4">Dettagli</a>
    
                                <a href="{{ route('admin.apartments.edit', ['apartment' => $apartment->id ]) }}" class="btn btn-outline-warning my-4">Modifica</a>
                                
                                <a href="{{ route('admin.apartments.messages', ['apartment' => $apartment->id ]) }}"  class="btn btn-outline-warning my-4">Messaggi</a>
                                <form 
                                    onsubmit="return confirm('Sei sicuro di voler cancellare questo appartamento?')"
                                    action="{{ route('admin.apartments.destroy', ['apartment' => $apartment->id]) }}" 
                                    method="POST" 
                                    class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger">
                                        Elimina
                                    </button>
                                </form>
                            </div>

                        </div>
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
