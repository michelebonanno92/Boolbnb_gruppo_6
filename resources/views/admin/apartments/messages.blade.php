@extends('layouts.app')

@section('page-title', 'Messaggi')

@section('main-content')
<div class="container">
    <h1 class="mb-4">Messaggi per l'appartamento: {{ $apartment->title }}</h1>

    <div class="card mb-4">
        <div class="card-body">
            <h4>{{ $apartment->title }}</h4>
            <p><strong>Indirizzo:</strong> {{ $apartment->address }}</p>
            <p><strong>Descrizione:</strong> {{ $apartment->description }}</p>
        </div>
    </div>

    <h2>Messaggi ricevuti</h2>
    @if($messages->isEmpty())
        <p>Non ci sono messaggi per questo appartamento.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Messaggio</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $message)
                    <tr>
                        <td>{{ $message->name }}</td>
                        <td>{{ $message->email }}</td>
                        <td>{{ $message->message }}</td>
                        <td>{{ $message->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('admin.apartments.index') }}" class="btn btn-primary">Torna agli appartamenti</a>
</div>
@endsection
