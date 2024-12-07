@extends('layouts.app')

@section('page-title', ' BoolBnb Dashboard')

@section('main-content')
<div class="mb-4">
    <div class="row">
        <div class="col-3 ms-auto">
            
            <div class="card-body">
                <p class="text-center fw-semibold text-secondary mb-0">
                    Bentornato {{ $user->name }}
                </p> 
            </div>
            
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-6 text-center mb-4">
            
            <img src="{{ asset('/boolbnbnew.png') }}" alt="boolbnb logo">
            
        </div>
    </div>
</div>
<div class="container mb-4">
    <div class="row">
        <div class="col-12 text-center fs-2 fw-bold text-secondary">
            Le tue statistiche...
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-12 col-lg-6 mb-4">
            <div class="">
                <div>
                    <div class="p-3">
                        <canvas id="myChartViews"></canvas>
                    </div>
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script>
                        const ctx = document.getElementById('myChartViews');
                        const apartments = @json($apartments); // Converte $apartments in JSON
                        const views = @json($viewsCounts); // Converte $apartments in JSON
                        console.log(apartments); // Debug per verificare i dati in console
                    
                        // Supponendo che apartments sia un array di oggetti con proprietà come "name" e "votes"
                        const labels = apartments.map(apartment => apartment.title); // Estrai i nomi degli appartamenti
                        const data = views.map(apartment => apartment.view_count);  // Estrai i dati, ad esempio le visualizzazioni o altro
                    
                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels, // Usa i nomi degli appartamenti come etichette
                                datasets: [{
                                    label: '# di Visualizzazioni',
                                    data: data, // Usa i dati degli appartamenti
                                    borderWidth: 1,
                                    backgroundColor: 'rgb(240,128,128, 0.5)',
                                    borderColor: 'rgb(240,128,128)',
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 mb-4">
            <div class="">
                <div class="p-3">
                    <canvas id="myChartMessages"></canvas>
                </div>
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script>
                        const ciccio = document.getElementById('myChartMessages');
                        // const apartments = @json($apartments); // Converte $apartments in JSON
                        const messages = @json($messageCounts); // Converte $apartments in JSON
                        console.log(messages); // Debug per verificare i dati in console
                    
                        // Supponendo che apartments sia un array di oggetti con proprietà come "name" e "votes"
                        const messLabels = apartments.map(apartment => apartment.title); // Estrai i nomi degli appartamenti
                        const messData = messages.map(apartment => apartment.message_count);  // Estrai i dati, ad esempio le visualizzazioni o altro
                    
                        new Chart(ciccio, {
                            type: 'bar',
                            data: {
                                labels: messLabels, // Usa i nomi degli appartamenti come etichette
                                datasets: [{
                                    label: '# di Messaggi',
                                    data: messData, // Usa i dati degli appartamenti
                                    borderWidth: 1,
                                    backgroundColor: 'rgb(184,240,128, 0.5)',
                                    borderColor: 'rgb(184,240,128)',
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col">
            {{-- <a href="{{ route('admin.apartments.index') }}">Tutti gli appartamenti</a> --}}
            {{-- <a class="nav-link btn btn" href="{{ route('admin.apartments.index') }}">
                <i class="fa-solid fa-house-flag"></i>
                Appartamenti
            </a> --}}
            <a href="{{ route('admin.apartments.index') }}" class="btn btn-outline-success my-4 w-100">Appartamenti</a>

        </div>
        <div class="col">
            <a href="{{ route('admin.apartments.create') }}" class="btn btn-outline-success my-4 w-100">Nuovo appartamento</a>
            {{-- <a href="{{ route('admin.apartments.create') }}">Aggiungi appartamenti</a> --}}
        </div>
    </div>
</div>
@endsection
