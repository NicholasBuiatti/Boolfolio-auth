@extends('layouts.NavAdmin')

@section('content')
	<div class="container">

		@if (session('message'))
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				<strong>{{ session('message') }}</strong>
			</div>
		@endif
		{{-- <p>{{ $project }}</p> --}}
		<div class="row">
			<div class="col-6">
				<img src="{{ $project->img }}" class="container-fluid">
			</div>
			<div class="col-6 d-flex flex-column justify-content-between">
				<h1>{{ $project->name_project }}</h1>
				<p class="">{{ $project->description }}</p>
				<div class="card-footer text-muted text-end">
					@if ($project->favorite == true)
						<i class="fa-solid fa-heart text-danger fs-5"></i>
					@endif

					Sviluppo: {{ $project->type->name }}
				</div>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-6 border-end">
				<p>Creazione progetto: {{ $project->date }}</p>
				<p>Vai al progetto su GitHub cliccando <a href="{{ $project->git_URL }}">QUI</a>.</p>
				<a href="{{ route('admin.project.index') }}" class="btn btn-primary" role="button">
					<i class="fa-solid fa-arrow-left"></i>
				</a>
				<a href="{{ route('admin.project.edit', $project) }}" class="btn btn-warning" role="button">
					<i class="fa-solid fa-pen"></i>
				</a>
			</div>
			<div class="col-6">
				<h5>Linguaggi e Framework usati:</h5>
				<ul class="list-unstyled">
					@foreach ($project->languages as $language)
						<li><i class="{{ $language->icon }} me-2 fs-4"></i>{{ $language->name }}</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
@endsection
