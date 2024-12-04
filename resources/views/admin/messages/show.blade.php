@extends('layouts.app')

@section('page-title', $message->name)

@section('main-content')

	<div class="container">
		
        <div>
            {{ $message->name }}
        </div>
        <div>
            {{ $message->apartment->title }}
        </div>
        <div>
            {{ $message->message }}
        </div>

         <button class="btn btn-outline-warning">
            Rispondi
         </button>
       
	</div>

@endsection
