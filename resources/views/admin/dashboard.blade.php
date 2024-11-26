@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('main-content')
    <div class="container mb-4">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h1 class="text-center text-success">
                            Bentornato {{ $user->name }}
                        </h1> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-4">
        <div class="row">
            <div class="col-12 text-center fs-2 fw-bold text-success">
                DASHBOARD
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card p-3">
                    placeholder visualizazioni
                </div>
                <div>
                    Appartamento casa bella:...
                </div>
            </div>
            <div class="col">
                <div class="card p-3">
                    placeholder messaggi <a href="#">Vedi tutti i messaggi...</a>
                </div>
            </div>
        </div>
    </div>
@endsection
