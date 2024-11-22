@extends('layouts.guest')

@section('main-content')
    <div class="row">
        <a href="{{route('admin.apartments.index') }}" class="btn btn-primary w-100">
            Tutti gli appartamenti
        </a>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-primary">
                        Welcome!
                    </h1>
                    <br>
                    La welcome page è una pagina pubblica (NON protetta)
                </div>
            </div>
        </div>
    </div>
@endsection
