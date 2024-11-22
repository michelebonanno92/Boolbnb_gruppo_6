@extends('layouts.app')

@section('page-title', 'Appartamenti')

@section('main-content')
    

    <ol>
        @foreach ($apartments as $apartment)
        <li>
            {{ $apartment->title }}
        </li> 
        @endforeach
    </ol>

@endsection
