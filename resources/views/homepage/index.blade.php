@extends('layouts.guest')

@section('main-content')
    <div class="row">
        {{-- <a href="{{route('Welcome') }}" class="btn btn-primary w-100">
            Tutti gli appartamenti
        </a> --}}
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-primary">
                        Tutti gli appartamenti
                    </h1>
                    <br>
                    
                </div>
            </div>
        </div>

        <ul>
            @foreach ($apartments as $apartment)
                @if ($apartment->visible)
                    <li>
                        {{ $apartment->title }} -> <a href="{{ route('homepage.show', $apartment->id) }}" >Dettagli</a>
                    </li> 
                @endif
            @endforeach
        </ul>
    </div>
@endsection
