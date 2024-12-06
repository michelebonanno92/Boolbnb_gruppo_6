@extends('layouts.app')

@section('page-title','Messaggio di '.$message->name)

@section('main-content')

	<div class="container">
		
        <div class="mb-2">
            {{ $message->name }}
        </div>
        <div class="mb-2">
            {{ $message->apartment->title }}
        </div>
        <div class="mb-2">
            {{ $message->message }}
        </div>
        <input type="text" class="form-control mb-3">
        <a href="{{ route('admin.apartments.messages', ['apartment' => $message->apartment->id ]) }}" class="btn btn-outline-secondary">Indietro</a>
        <button class="btn btn-outline-warning">
            Rispondi
        </button>
       
	</div>

@endsection
