@extends('layouts.admin')

@section('content')
	<h1 class="text-center mb-5">Ecco la lista di tutti i progetti</h1>
	@foreach ($projects as $project)
		<div class="card bg-dark text-white mb-4" style="min-height: 10rem">
			<img src="" class="card-img">
			<div class="card-img-overlay">
				<h5 class="card-title">Titolo: {{ $project->name_project }}</h5>
				<p class="card-text">Data: {{ $project->date }}</p>
				{{-- RIPORTO IN ROUTE IL LINK DA SCRIVERE NELL'URL PER APRIRE LA PAGINA --}}
				<a href="{{ route('admin.project.show', $project) }}" class="btn btn-info" href="#" role="button">Show</a>
				<a href="{{ route('admin.project.edit', $project) }}" class="btn btn-Secondary" href="#"
					role="button">Modify</a>
				<form action="{{ route('admin.project.destroy', $project->id) }}" method="POST" class="d-inline">
					@method('DELETE')
					@csrf
					<button type="submit" class="btn btn-danger mt-1">Delete</button>
				</form>
			</div>
		</div>
	@endforeach
@endsection
