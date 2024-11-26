@extends('layouts.guest')

@section('main-content')
    <form method="POST" action="{{ route('register') }}">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row mb-2">
            <div class="col-12 col-md-6 col-lg-2">
                <label for="name">
                    <span class="text-danger">*</span>Campi obbligatori
                </label>
            </div>
        </div>
        <!-- Name -->
        <div class="row mb-2">
            <div class="col-12 col-md-6 col-lg-1">
                <label for="name">
                    Nome<span class="text-danger">*</span>
                </label>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-12 col-md-6 col-lg-2">
                <input type="text" id="name" name="name" required min="3" max="64">
            </div>
        </div>

        <!-- Surname -->
        <div class="row mb-2">
            <div class="col-12 col-md-6 col-lg-1">
                <label for="surname">
                    Cognome<span class="text-danger">*</span>
                </label>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-12 col-md-6 col-lg-2">
                <input type="text" id="surname" name="surname" required min="3" max="64">
            </div>
        </div>
        
        <!-- Date of birth -->
        <div class="row mb-2">
            <div class="col-12 col-md-6 col-lg-2">
                <label for="date_of_birth">
                    Data di nascita<span class="text-danger">*</span>
                </label>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-12 col-md-6 col-lg-2">
                <input type="date" id="date_of_birth" name="date_of_birth" required>
            </div>
        </div>

        <!-- Email Address -->
        <div class="row mb-2">
            <div class="col-12 col-md-6 col-lg-1">
                <label for="email">
                    Email<span class="text-danger">*</span>
                </label>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-12 col-md-6 col-lg-2">
                <input type="email" id="email" name="email" required>
            </div>
        </div>

        <!-- Password -->
        <div class="row mb-2">
            <div class="col-12 col-md-6 col-lg-1">
                <label for="password">
                    Password<span class="text-danger">*</span>
                </label>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-12 col-md-6 col-lg-2">
                <input type="password" id="password" name="password" required>
            </div>
        </div>
        
        <!-- Confirm Password -->
        <div class="row mb-2">
            <div class="col-12 col-md-6 col-lg-2">
                <label for="password_confirmation">
                    Conferma Password<span class="text-danger">*</span>
                </label>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-12 col-md-6 col-lg-2">
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
        </div>

        <div class="py-2">
            <a href="{{ route('login') }}" class="me-2 btn btn-outline-primary">
                {{ __('Già registrato?') }}
            </a>

            <button type="submit" class="btn btn-success">
                Registrati
            </button>
        </div>
    </form>
@endsection
