@extends('layouts.app')

@section('page-title', 'Messaggi')

@section('main-content')
    <div class="container">
        <div class="d-flex justify-content-center pb-4">
            <h1>Elenco Messaggi</h1>
        </div>

        @if(isset($messages) && $messages->count())
            @foreach ($messages as $message)
                <div>
                    <strong>Titolo Appartamento:</strong> {{ $message->apartment->title }}<br>
                    <strong>Mittente</strong> {{ $message->email }}<br>
                    <strong>Messaggio:</strong> {{ $message->message }}
                </div>
            @endforeach
        @else
            <h2>
                Non hai ancora ricevuto messaggi...
            </h2>
        @endif
    </div>
@endsection
