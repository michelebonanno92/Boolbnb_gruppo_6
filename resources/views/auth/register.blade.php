@extends('layouts.guest')

@section('page-title', 'BoolBnb Registrazione')

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 offset-md-3">
                <div class="card form-card p-4">
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
                        <div>
                            <label for="name"  class="form-label fw-bold">
                                <span class="text-danger">*</span>Campi obbligatori
                            </label>
                        </div>
                        <!-- Name -->
                        <label for="name" class="form-label fw-bold">
                            Nome<span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" id="name" name="name" required min="3" max="64">
                        
                
                        <!-- Surname -->
                        <div>
                            <label for="surname" class="form-label fw-bold">
                                Cognome<span class="text-danger"></span>
                            </label>
                        </div>
                        <input type="text" class="form-control" id="surname" name="surname" min="3" max="64">
                        
                        
                        <!-- Date of birth -->
                        <div>
                            <label for="date_of_birth" class="form-label fw-bold">
                                Data di nascita<span class="text-danger">*</span>
                            </label>
                        </div>
                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
                        
                
                        <!-- Email Address -->
                        <div>
                            <label for="email" class="form-label fw-bold">
                                Email<span class="text-danger">*</span>
                            </label>
                        </div>
                        <input type="email" class="form-control" id="email" name="email" required>
                        
                
                        <!-- Password -->
                        <div>
                            <label for="password" class="form-label fw-bold">
                                Password<span class="text-danger">*</span>
                            </label>
                        </div>
                        <input type="password" class="form-control" id="password" name="password" required>
                        
                        
                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="form-label fw-bold">
                                Conferma Password<span class="text-danger">*</span>
                            </label>
                        </div>
                        <input type="password" class="form-control mb-2" id="password_confirmation" name="password_confirmation" required>
                        
                
                        <div class="py-2">
                            <a href="{{ route('login') }}" class="me-2 btn btn-outline-primary">
                                {{ __('Già registrato?') }}
                            </a>
                
                            <button type="submit" class="btn btn-success">
                                Registrati
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
