@extends('layouts.app')

@section('page-title', $apartment->name )

@section('main-content')

  <div class="card w-100 mb-3 text-center">
    <div class="card-body">
      <h5 class="card-title">{{ $apartment->title}}</h5>
      <p class="card-text">{{ $apartment->id}}</p>
      <p class="card-text">{{ $apartment->slug}}</p>
   
  
      <a href="{{ route('admin.apartments.edit', ['apartment' => $apartment->id]) }}" class="btn btn-warning">Modifica</a>
      <form 
        {{-- aggiunto conferma di cancellazione --}}
          onsubmit="return confirm('sei sicuro di volerlo cancellare ?')"
          action="{{ route('admin.apartments.destroy', ['apartment' => $apartment->id]) }}" 
          method="POST" 
          class="d-inline-block">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">
              Elimina
          </button>
      </form>
    </div>
  </div>
@endsection
