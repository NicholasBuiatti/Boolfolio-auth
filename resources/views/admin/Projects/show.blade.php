@extends('layouts.admin')

@section('content')
	@if (session('message'))
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			<strong>{{ session('message') }}</strong>
		</div>
	@endif

	<h1>{{ $project->name_project }}</h1>
	<div class="card mt-5">
		<img
			src="{{ $project->img = Str::startsWith($project->img, 'https') ? $project->img : asset('storage/' . $project->img) }}"
			class="card-img-top" alt="" style="height: 18rem">
		<div class="card-body">
			<h5 class="card-title">{{ $project->name_project }}</h5>
			<p class="card-text">{{ $project->description }}</p>
			<p class="card-text my-4">
				Categoria: <a href="{{ route('admin.type.show', $project->id) }}">{{ $project->type->name }}</a>
			</p>
			<p>linguaggio
			<ul>
				@foreach ($project->languages as $language)
					<li>{{ $language->name }}</li>
				@endforeach
			</ul>

			</p>
			<p class="card-text"><small class="text-muted">{{ $project->date }}</small></p>
		</div>
	</div>
@endsection
