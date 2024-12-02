@extends('layouts.app')

@section('page-title', 'Messaggi')

@section('main-content')
    <div class="container">
        <div class="text-center py-4">
            <h1>Elenco Messaggi</h1>
        </div>

        <div class="row">
            <div class="col-12 col-md-6 offset-md-3">
                @if(isset($messages) && $messages->count())
                    @foreach ($messages as $message)
                        <div class="message-card rounded mb-2 p-3">
                            <div>
                                <strong>Titolo Appartamento:</strong> {{ $message->apartment->title }}
                            </div>
                            <div>
                                <strong>Mittente</strong> {{ $message->email }}
                            </div>
                            <div>
                                <strong>Messaggio:</strong> {{ $message->message }}
                            </div>
                        </div>
                    @endforeach
                @else
                    <h2>
                        Non hai ancora ricevuto messaggi...
                    </h2>
                @endif
            </div>
        </div>
    </div>
@endsection
