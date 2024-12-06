@extends('layouts.app')

@section('page-title', 'Messaggi')

@section('main-content')
<div class="container">
    <h1 class="text-center mb-4">Messaggi dell'appartamento: {{ $apartment->title }}</h1>

    <h2 class="text-center">Messaggi ricevuti</h2>
    @if($messages->isEmpty())
        <p>Non ci sono messaggi per questo appartamento.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Data</th>
                    <th>visualizza</th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $message)
                    <tr>
                        <td>{{ $message->name }}</td>
                        <td>{{ $message->email }}</td>
                        <td>{{ $message->created_at->format('d/m/Y H:i') }}</td>
                        <td><a href="{{ route('admin.messages.show', $message->id) }}" class="btn btn-warning">Visualizza</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('admin.apartments.index') }}" class="btn btn-primary">Torna agli appartamenti</a>
</div>
@endsection
