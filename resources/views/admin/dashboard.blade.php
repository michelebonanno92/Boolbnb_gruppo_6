@extends('layouts.app')

@section('page-title', ' BoolBnb Dashboard')

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-6 text-center mb-4">
            
            <img src="{{ asset('/boolbnbnew.png') }}" alt="boolbnb logo">
            
        </div>
    </div>
</div>
    <div class="container mb-4">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h1 class="text-center text-dark mb-0">
                            Bentornato {{ $user->name }}
                        </h1> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-4">
        <div class="row">
            <div class="col-12 text-center fs-2 fw-bold text-warning">
                DASHBOARD
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card p-3">
                    <div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Appartamento</th>
                                    <th class="text-center">Visualizzazioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($viewsCounts as $item)
                                    <tr>
                                        <td>{{ $item->apartment_name }}</td>
                                        <td class="text-center fw-bold">{{ $item->view_count }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card p-3">
                    <div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Appartamento</th>
                                    <th class="text-center">Messaggi ricevuti</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($messageCounts as $item)
                                    <tr>
                                        <td>{{ $item->apartment_name }}</td>
                                        <td class="text-center fw-bold">{{ $item->message_count }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <a href="{{ route('admin.messages.index') }}" class="btn btn-warning">Vedi tutti i messaggi...</a>
                </div>
            </div>
        </div>
    </div>
@endsection
