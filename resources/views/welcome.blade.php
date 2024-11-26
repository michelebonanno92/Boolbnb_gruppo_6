@extends('layouts.guest')

@section('main-content')
    <div class="row">
        
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-primary">
                        BoolBnb
                    </h1>
                    <br>
                    <a href="{{route('homepage.index') }}" class="btn btn-primary w-100">
                        Tutti gli appartamenti
                    </a>
                </div>
            </div>
        </div>

    </div>
@endsection
