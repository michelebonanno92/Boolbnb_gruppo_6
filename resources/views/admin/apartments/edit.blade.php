@extends('layouts.app')

@section('page-title' , 'Modifica il tuo progetto')

@section('main-content')
<h1>
  Modifica Progetto
</h1>

{{-- @if ($errors->any())
  <div class="alert alert-danger my-4">
    <ul>
      @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
    </ul>
@endif --}}

<form action="{{ route('admin.projects.update',['project' => $project->id])}}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <div class="mb-3">
    <label for="name" class="form-label">Nome</label>
    <input type="text" class="form-control" id="name"  name="name" value="{{ old('name', $project->name) }}" required maxlength="6">
    @error('name')
      <div class="alert alert-danger mt-2">
        Errore Nome: {{ $message }}
      </div>
    @enderror
  </div>

  <div class="mb-3">
      <label for="type_id" class="form-label">Tipologia di progetto</label>
      <select id="type_id" name="type_id"  class="form-select" aria-label="Default select example">
          <option
          {{-- con questo lo selezioniamo solo se non era stato selezionato --}}
          @if (old('type_id', $project->type_id) == null)
              selected
          @endif
            value="">Seleziona una tipologia</option>
          @foreach ($types as $type)
            <option 
            {{-- con questo se l'old è uguale ad un id allora facciamo la selezione con il selected --}}
                @if (old('type_id', $project->type_id) == $type->id)
                selected   
                @endif
                value="{{ $type->id }}">{{ $type->title }}</option>
          @endforeach
      </select>
      @error('type_id')
        <div class="alert alert-danger mt-2">
          Errore Tipologia: {{ $message }}
        </div>
      @enderror
  </div>

  <div class="mb-3">
    <label for="file" class="form-label">Immagine</label>
    <input type="file" class="form-control" id="file"  name="file">

    <div class="mt-4">
    
      @if ($project->file)
      
        <h5 class="mb-2">
          Immagine attuale :
        </h5>

        <img src="{{ asset('/storage/'.$project->file) }}" alt="{{ $project->name }}" style="height: 100px" >

        <div class="form-check mt-2">
          <input class="form-check-input" type="checkbox" value="1" id="remove_img" name="remove_img">
          <label class="form-check-label" for="remove_img">
            Rimuovi immagine attuale
          </label>
        </div>

      @endif
    </div>

    @error('file')
    <div class="alert alert-danger mt-2">
      Errore immagine: {{ $message }}
    </div>
  @enderror
  </div>

  <div class="mb-3">
    <div>
      <label for="type_id" class="form-label">tecnologie</label>
    </div>
    @foreach ($technologies as $technology)
      <div class="form-check form-check-inline">
        <input 
        {{-- se la collezione delle tecnologie associate al project contiene l'id della tecnologia che sto considerando allora aggiungo l'attributo checked--}}
            @if ($project->technologies->contains($technology->id))
                checked
            @endif
            class="form-check-input" 
            type="checkbox" 
            id="technology-{{ $technology->id }}" 
            name="technologies[]" 
            value="{{ $technology->id }}">
        <label class="form-check-label" for="technology-{{ $technology->id }}">
          {{ $technology->name }}
        </label>
      </div>
    @endforeach
</div>
  
  <button type="submit" class="btn btn-primary w-100">
    + Modifica
   </button>
</form>
@endsection
