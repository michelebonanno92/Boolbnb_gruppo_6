@extends('layouts.app')

@section('page-title' , 'Aggiungi servizi')

@section('main-content')
	<h1>
		Aggiungi servizio
	</h1>

	<form action="{{ route('admin.services.store')}}" method="POST">
		@csrf

		<div class="mb-3">
			<label for="title" class="form-label">Servizio: <span class="text-danger">*</span></label>
			<input type="text" class="form-control" id="service_name"  name="service_name" placeholder="Inserisci il nome del servizio..." required minlength="3" maxlength="255">
			@error('title')
				<div class="alert alert-danger mt-2">
					Nome servizio non valido...
				</div>
			@enderror
		</div>
	
		<button type="submit" class="btn btn-success">
			+ Aggiungi
		</button>
	</form>
@endsection
