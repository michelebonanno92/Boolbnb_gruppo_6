@extends('layouts.app')

@section('page-title', 'Messaggi')

@section('main-content')
    <div class="container">
        <div class="text-center py-4">
            <h1>Elenco Messaggi</h1>
        </div>

        <div class="row">
            <div class="col-12 col-md-6 offset-md-3">
                @if(isset($messages) && $messages->count())

                <div class="accordion" id="accordionExample">
                    @foreach($apartments as $key => $apartment)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $key }}">
                          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $key }}" aria-expanded="false" aria-controls="collapse{{ $key }}">
                            {{ $apartment->title }}
                          </button>
                        </h2>
                        <div id="collapse{{ $key }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $key }}" data-bs-parent="#accordionExample">
                            @foreach ($messages as $message)
                                @if($message->apartment_id == $apartment->id)
                                    <div class="accordion-body">
                                       <a href="{{ route('admin.messages.show', $message->id) }}">
                                            <div>
                                                Mittente: {{ $message->name }}
                                            </div>
                                            <div>
                                                Email: {{ $message->email }}
                                            </div>
                                       </a>
                                    </div>
                                @endif
                            @endforeach
                          </div>
                      </div>
                    @endforeach
                </div>
                @else
                    <h2>
                        Non hai ancora ricevuto messaggi...
                    </h2>
                @endif
            </div>
        </div>
    </div>
@endsection
