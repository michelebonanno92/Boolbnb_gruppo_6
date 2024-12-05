@extends('layouts.app')

@section('page-title', $message->name)

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
        <button class="btn btn-outline-warning">
            Rispondi
        </button>
       
	</div>

@endsection
