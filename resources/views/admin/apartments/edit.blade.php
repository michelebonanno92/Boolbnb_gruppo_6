@extends('layouts.app')

@section('page-title' , 'Crea il tuo appartmanto')

@section('main-content')
<h1>
  Modifica Appartamento
</h1>

<form action="{{ route('admin.apartments.update', ['apartment' => $apartment->id])}}" method="POST" enctype="multipart/form-data" >
  {{-- enctype="multipart/form-data" serve per inviare i file in un form --}}
    @csrf
  @method('PUT')


    {{-- FARE COLLEGAMENTO ALLO STORAGE LINK  --}}
    <div class="mb-3">
      <label for="image" class="form-label">Immagine</label>
      <input type="file" class="form-control" id="image"  name="image">
      @if($apartment->image)

          <div class="mb-2">
            Immagine attuale :
          </div>

          <img src="{{ asset('/storage/'.$apartment->image) }}" alt="{{ $apartment->title }}" style="height: 100px">
      
      @endif
      @error('image')
      <div class="alert alert-danger mt-2">
        Errore immagine: {{ $message }}
      </div>
       @enderror
    </div>

    <div class="mb-3">
      <label for="title" class="form-label">Titolo</label>
      <input type="text" class="form-control" id="title"  name="title" placeholder="Inserisci il nome dell'appartamento..." value="{{old('title', $apartment->title)}}" required minlength="3" maxlength="255">
      @error('title')
        <div class="alert alert-danger mt-2">
          Errore Titolo: {{ $message }}
        </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="rooms" class="form-label">Numero stanze</label>
      <input type="number" class="form-control" id="rooms"  name="rooms" placeholder="Inserisci il numero delle stanze..." value="{{old('rooms', $apartment->rooms)}}" required  min="1" max="20">
      @error('rooms')
        <div class="alert alert-danger mt-2">
          Errore Stanze: {{ $message }}
        </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="beds" class="form-label">Numero letti</label>
      <input type="number" class="form-control" id="beds"  name="beds" placeholder="Inserisci il numero dei letti..." value="{{old('beds' , $apartment->beds)}}" required  min="1" max="33">
      @error('beds')
        <div class="alert alert-danger mt-2">
          Errore Letti: {{ $message }}
        </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="toilets" class="form-label">Numero bagni</label>
      <input type="number" class="form-control" id="toilets"  name="toilets" placeholder="Inserisci il numero dei bagni..." value="{{old('toilets' , $apartment->toilets)}}" required  min="1" max="10">
      @error('toilets')
        <div class="alert alert-danger mt-2">
          Errore Bagni: {{ $message }}
        </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="square_meters" class="form-label">Numero metri quadri</label>
      <input type="number" class="form-control" id="square_meters"  name="square_meters" placeholder="Inserisci il numero dei metri quadri..." value="{{old('square_meters' , $apartment->square_meters)}}" required  min="20" max="300">
      @error('square_meters')
        <div class="alert alert-danger mt-2">
          Errore metri quadri: {{ $message }}
        </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="address" class="form-label">Indirizzo</label>
      <input type="text" class="form-control" id="address"  name="address" placeholder="Inserisci l'indirizzo..." value="{{old('address', $apartment->address )}}" required minlength="10" maxlength="255">
      @error('address')
        <div class="alert alert-danger mt-2">
          Errore Indirizzo: {{ $message }}
        </div>
      @enderror
    </div>

    
    <div class="mb-3">
      
            <div class="form-check">
                <input
                    @if (old('visible', $apartment->visible == true ))  
                        checked
                    @endif
                    class="form-check-input" 
                    type="radio" 
                    name="visible" 
                    id="visible" 
                    value="true">
                    <label class="form-check-label" for="visible">
                        Pubblica
                    </label>
            </div>
            <div class="form-check">
                <input 
                    @if (old('visible', $apartment->visible == false ))  
                        checked
                    @endif
                    class="form-check-input" 
                    type="radio" 
                    name="visible" 
                    id="not-visible" 
                    value="false">
                    <label class="form-check-label" for="not-visible">
                        Nascondi
                    </label>
            </div>
            
      </div>


  
  <button type="submit" class="btn btn-primary w-100">
    + Modifica
   </button>
</form>
@endsection
