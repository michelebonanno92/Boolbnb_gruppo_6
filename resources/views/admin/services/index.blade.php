@extends('layouts.app')

@section('page-title', 'Servizi')

@section('main-content')
    

    <div class="container">
        <div class="d-flex justify-content-center pb-4">
            <h1>Elenco servizi</h1>
        </div>
        <ul>
           @foreach ( $services as $service )
               <li>
                    <div class="fs-3">
                        {{ $service->service_name }}
                    </div>
                  
                    <a href="{{ route('admin.services.edit', $service->id) }}">Modifica</a>

                    <form 
						onsubmit="return confirm('Sei sicuro di voler cancellare questo servizio?')"
						action="{{ route('admin.services.destroy', ['service' => $service->id]) }}" 
						method="POST" 
						class="d-inline-block">
						@csrf
						@method('DELETE')
						<button type="submit" class="btn btn-outline-danger">
							Elimina
						</button>
					</form>

               </li>
           @endforeach
        </ul>

        <div>
            <a href="{{ route('admin.services.create') }}" class="btn btn-primary my-4">Aggiungi servizi</a>
        </div>
    </div>
    
    

@endsection
