@extends('layouts.guest')

@section('main-content')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        @if (session('status'))
            <div class="alert alert-danger">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

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

        <!-- Remember Me -->
        <div class="mt-4">
            <label for="remember_me">
                <input id="remember_me" type="checkbox" name="remember">
                <span>Ricordami</span>
            </label>
        </div>

        <div class="mt-4">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="me-2 btn btn-outline-danger">
                    {{ __('Password dimenticata?') }}
                </a>
            @endif

            <button type="submit" class="btn btn-success">
                Log in
            </button>
        </div>
    </form>
@endsection
