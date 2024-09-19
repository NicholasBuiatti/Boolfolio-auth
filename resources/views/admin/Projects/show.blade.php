@extends('layouts.NavAdmin')

@section('content')
	<div class="container">

		@if (session('message'))
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				<strong>{{ session('message') }}</strong>
			</div>
		@endif
		<p>{{ $project }}</p>
		<div class="row">
			<div class="col-6">
				<img src="{{ $project->img }}" class="container-fluid">
			</div>
			<div class="col-6 d-flex flex-column justify-content-between">
				<h1>{{ $project->name_project }}</h1>
				<p class="">{{ $project->description }}</p>
				<div class="card-footer text-muted text-end">
					Sviluppo: {{ $project->type->name }}
				</div>
			</div>
		</div>
		<hr>
		<div class="row">
			<ul>
				@foreach ($project->languages as $language)
					<li>{{ $language->name }}</li>
				@endforeach
			</ul>
		</div>
	</div>

	{{-- <div class="card mt-5">
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
	</div> --}}
	</div>
@endsection
