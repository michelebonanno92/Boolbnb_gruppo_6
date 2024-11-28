@extends('layouts.guest')

@section('main-content')
<div class="container">
    <div class="row mb-2">
        <div class="col-12 col-md-6 offset-md-3">
            <div class="card form-card p-4">
                <div class="mb-2">
                    {{ __('Hai dimenticato la password? Nessun problema. Facci sapere il tuo indirizzo email e ti invieremo un link per reimpostare la password.') }}
                </div>
            
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
            
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">
                            Email<span class="text-danger">*</span>
                        </label>
                        <input type="email" id="email" name="email"  class="form-control" required>
                    </div>
            
                    <div>
                        <button type="submit" class="btn btn-success">
                            Reimposta Password
                        </button>
                    </div>
                    
                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection
