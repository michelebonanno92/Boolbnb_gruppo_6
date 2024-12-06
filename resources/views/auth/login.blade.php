@extends('layouts.guest')

@section('page-title', 'BoolBnb Login')

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

        <div class="container">
            <div class="row mb-2">
                <div class="col-12 col-md-6 offset-md-3">
                    <div class="card form-card p-4">
                        <label for="email" class="form-label fw-bold">
                            Email<span class="text-danger">*</span>
                        </label>
                        <input type="email" id="email" name="email" required class="form-control">

                <!-- Password -->
                        <label for="password" class="form-label fw-bold">
                            Password<span class="text-danger">*</span>
                        </label>
                    
                        <input type="password" id="password" name="password" required class="form-control">

                <!-- Remember Me -->
                        <label for="remember_me">
                            <input id="remember_me" type="checkbox" name="remember">
                            <span>Ricordami</span>
                        </label>

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
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
