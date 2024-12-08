@extends('layouts.app')

@section('page-title', ' BoolBnb Dashboard')

@section('main-content')
<div class="container mb-4 py-3">
    <div class="row ">
        <div class="col">
            {{-- <img src="{{ asset('/boolbnbnew.png') }}" alt="boolbnb logo" class="h-75"> --}}
            <div class="d-flex align-items-start justify-content-start py-2">
                <i class="fa-solid fa-door-open me-1 text-warning fa-2x"></i><h4 class="text-dark m-0">BoolBnb</h4>
            </div>

        </div>
        <div class="col-3 ms-auto d-flex justify-content-end pe-0 align-items-center  ">
                <p class="text-center fw-semibold text-secondary mb-0 pb-3">
                    Bentornato {{ $user->name }}
                </p> 
            </div>
        </div>
    </div>
    {{-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-6 text-center mb-4">
                
                <img src="{{ asset('/boolbnbnew.png') }}" alt="boolbnb logo">
                
            </div>
        </div>
    </div> --}}
    <div class="container mb-4">
        <div class="row">
            <div class="col-12 text-center fs-2 fw-bold text-secondary">
                Le tue statistiche...
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6 mb-4 ">
                <div class="p-3  d-flex justify-content-center">
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
            <div class="col-12 col-lg-6 mb-4">
                <div class="p-3 d-flex justify-content-center">
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
<div class="container">
    <div class="row">
        <div class="col">
            <a href="{{ route('admin.apartments.index') }}" class="mt-4 btn btn-outline-primary w-100">Tutti gli appartamenti</a>
        </div>
        <div class="col">
            <a href="{{ route('admin.apartments.create') }}" class="mt-4 btn btn-primary w-100">Aggiungi appartamenti</a>
        </div>
    </div>
</div>
@endsection
