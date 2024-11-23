@extends('layouts.app')

@section('page-title', 'Appartamenti')

@section('main-content')
    

    <div class="container">
        <div class="d-flex justify-content-center pb-4">
            <h1>I miei appartamenti</h1>
        </div>
        <div>
            <a href="{{ route('admin.apartments.create') }}" class="btn btn-warning w-100 mb-4">Crea appartamento</a>
        </div>
        
        <div class="row">
            
            @foreach ($apartments as $apartment)
        
                <div class="col-12 col-sm-6 col-md-3 col-lg-2 d-flex align-content-between">
                    <div class="card mb-4 card-apartment  ">
                        <img src="{{ $apartment->image }}" class="card-img-top" alt="{{ $apartment->title }}">
                        <div class="card-body">
                          <h3 class="card-title">{{ $apartment->title }}</h3>
                          <p class="card-text">{{ $apartment->address }}</p>
                          <a href="{{ route('admin.apartments.show', ['apartment' => $apartment->id]) }}" class="btn btn-primary">Visualizza appartamento</a>
                        </div>
                      </div>
                </div>
        
            @endforeach
        

        </div>
    </div>
    
    

@endsection
