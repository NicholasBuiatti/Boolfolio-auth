@extends('layouts.admin')

@section('content')
	<h1 class="text-center mb-5">{{ $type->name }}</h1>
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">{{ $type->name }}</h5>
			<h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>
			<p class="card-text">{{ $type->description }}</p>
			<a href="#" class="card-link">Articolo {{ $type->name }}</a>
		</div>
	</div>
@endsection
