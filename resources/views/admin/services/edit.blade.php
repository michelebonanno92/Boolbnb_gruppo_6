@extends('layouts.app')

@section('page-title' , 'Modifica servizio')

@section('main-content')
	<h1>
	Modifica servizio
	</h1>

	<form action="{{ route('admin.services.update', $service->id)}}" method="POST">
		@csrf
		@method('PUT')
		<div class="mb-3">
			<label for="title" class="form-label">Servizio: <span class="text-danger">*</span></label>
			<input type="text" class="form-control" id="service_name"  name="service_name" placeholder="Inserisci il nome del servizio..." required minlength="3" maxlength="255" value="{{ $service->service_name  }}">
			@error('title')
				<div class="alert alert-danger mt-2">
					Nome servizio non valido...
				</div>
			@enderror
		</div>
	
		<button type="submit" class="btn btn-warning">
			+ Modifica
		</button>
		
		<a href="{{ route('admin.services.index')}}" class="btn btn-secondary">Annulla</a>
		
	</form>
@endsection
