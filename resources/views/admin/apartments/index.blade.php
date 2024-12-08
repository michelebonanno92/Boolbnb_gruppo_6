@extends('layouts.app')

@section('page-title', 'BoolBnb Appartamenti')

@section('main-content')
    

    <div class="container ">
        <div class="d-flex justify-content-center pb-1">
            <h1 class="fw-bold">I Tuoi Appartamenti e Casette </h1>
        </div>
        
        <div class="container">
            <div class="row">
                <div class="col-12 mb-2">
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

                        <div class="my-card py-2 px-4">
                            <div class="text-center mt-2 py-2">
                                <h3 class="m-0 me-3 p-0">
                                    {{ $apartment->title }}
                                </h3>
                            </div>
                            <div class="d-flex align-items-center justify-content-center py-3">
                                <div class="me-3">
                                    @if ($apartment->visible)
    
                                        <i class="fa-solid text-success fa-2x fa-eye"></i>
        
                                    @else
    
                                        <i class="fa-solid text-danger fa-2x fa-eye-slash"></i>
    
                                    @endif
                                </div>
                                <div class="d-flex align-items-center justify-content-center">
                                    @if($apartment->sponsorships->count())
                                        @if($apartment->sponsorships->count() > 1)
                                            <i class="fa-solid fa-bolt fa-2x me-2 text-warning"></i>
                                            <strong class="fs-4 me-1">
                                                {{ $apartment->sponsorships->sum('duration_hours') }}
                                            </strong>
                                            <strong class="fs-4">ore</strong>
                                        @else
                                            <i class="fa-solid fa-bolt fa-2x me-2 text-warning"></i>
                                            <strong class="fs-4 me-1">{{ $apartment->sponsorships->first()->duration_hours }}</strong>
                                            <strong class="fs-4">ore</strong>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="text-center mb-3 my-img-container">
                                @if ($apartment->image)
                                    <img src="{{ '/storage/'.$apartment->image }}" alt="{{ $apartment->title }}" class="my-img rounded">
                                @else
                                <img src="#" alt="da caricare" class="my-img rounded">
                                @endif
                            </div>
                            <ul class="m-0 mb-2 p-0">
                                <li class="m-0 p-0">
                                    Stanze: <span class="fw-bold">{{ $apartment->rooms }}</span>
                                </li>
                                <li class="m-0 p-0">
                                    Letti: <span class="fw-bold">{{ $apartment->beds }}</span>
                                </li>
                                <li class="m-0 p-0">
                                    Bagni: <span class="fw-bold">{{ $apartment->toilets }}</span>
                                </li>
                            </ul>
                            
                            <div class="flex-grow-1">
                                <h4>
                                    I tuoi servizi:
                                </h4>
                                <ul class="service-list mt-2 ">
                                    @foreach ($apartment->services as $service)
                                        <li class="fw-bold text-secondary me-3 p-0 my-services fs-6">
                                            {{ $service->service_name }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            
                            <div class="row justify-content-start">
                                <div class="col-12 col-md-3">
                                    <div class="w-100 mb-2">
                                        <a href="{{ route('admin.apartments.show', $apartment->id) }}" class="btn d-inline-block btn-primary w-100 me-2">Dettagli</a>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="w-100 mb-2">
                                        <a href="{{ route('admin.apartments.edit', ['apartment' => $apartment->id ]) }}" class="btn btn-outline-primary w-100 me-2">Modifica</a>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="w-100 mb-2">
                                        <a href="{{ route('admin.apartments.messages', ['apartment' => $apartment->id ]) }}"  class="btn btn-outline-primary w-100 me-2">Messaggi</a>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3 ms-auto">
                                    <div class="w-100 mb-2">
                                        <form 
                                            onsubmit="return confirm('Sei sicuro di voler cancellare questo appartamento?')"
                                            action="{{ route('admin.apartments.destroy', ['apartment' => $apartment->id]) }}" 
                                            method="POST" 
                                            class="d-inline-block w-100">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn w-100 btn-danger">
                                                Elimina
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="btn-container d-flex align-items-center justify-content-start py-3">

                                <div>
                                    <a href="{{ route('admin.apartments.show', $apartment->id) }}" class="btn d-inline-block btn-primary me-2">Dettagli</a>
                                </div>
    
                                <div>
                                    <a href="{{ route('admin.apartments.edit', ['apartment' => $apartment->id ]) }}" class="btn btn-outline-primary me-2">Modifica</a>
                                </div>
                                
                                <div>
                                    <a href="{{ route('admin.apartments.messages', ['apartment' => $apartment->id ]) }}"  class="btn btn-outline-primary me-2">Messaggi</a>
                                </div>

                                <div class="ms-auto">
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
                            </div> --}}

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
