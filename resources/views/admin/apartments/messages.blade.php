@extends('layouts.app')

@section('page-title', 'Messaggi')

@section('main-content')
<div class="container">
    <h1 class="text-center mb-5">Messaggi dell'appartamento: {{ $apartment->title }}</h1>

    @if($messages->isEmpty())
        <p>Non ci sono messaggi per questo appartamento.</p>
    @else
    <div class="row">
    @foreach($messages as $message)
        <div class="col-12 col-md-6">
            <div class="card text-center mb-4">
                <div class="card-header">
                    Messaggio da:
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $message->name }}</h5>
                    <p class="card-text">{{ $message->email }}</p>
                    <a href="{{ route('admin.messages.show', $message->id) }}" class="btn btn-primary">Visualizza</a>
                </div>
                <div class="card-footer text-body-secondary">
                    {{ $message->created_at->format('d/m/Y H:i') }}
                </div>
            </div>

        </div>
    @endforeach
    </div>
    
        {{-- <table class="table">
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
        </table> --}}
    @endif

    <a href="{{ route('admin.apartments.index') }}" class="btn btn-primary">Torna agli appartamenti</a>
</div>
@endsection
