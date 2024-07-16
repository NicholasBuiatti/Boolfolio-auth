@extends('layouts.admin')

@section('content')
	<h1>{{ $project->name_project }}</h1>
	<div class="card mt-5">
		<img src="" class="card-img-top" alt="">
		<div class="card-body">
			<h5 class="card-title">{{ $project->name_project }}</h5>
			<p class="card-text">{{ $project->description }}</p>
			@if ($project->group == true)
				<p class="card-text">Il progetto è stato fatto in gruppo</p>
			@endif
			<p class="card-text my-4">
				Categoria: <a href="{{ route('admin.type.show', $project->id) }}">{{ $project->type->name }}</a>
			</p>
			<p class="card-text"><small class="text-muted">{{ $project->date }}</small></p>
		</div>
	</div>
@endsection
