@extends('layouts.admin')

@section('content')
	<h1 class="text-center mb-5">Ecco la lista di tutti i progetti</h1>
	@foreach ($projects as $project)
		<div class="card bg-dark text-white mb-4" style="height: 15rem">
			<img src="{{ asset('storage/' . $project->img) }}" class="card-img object-fit-cover" style="height: 15rem">
			<div class="card-img-overlay">
				<h5 class="card-title">Titolo: {{ $project->name_project }}</h5>
				<p class="card-text">Data: {{ $project->date }}</p>
				<p>linguaggio
				<ul>
					@foreach ($project->languages as $language)
						<li>{{ $language->name }}</li>
					@endforeach
				</ul>

				</p>
				{{-- RIPORTO IN ROUTE IL LINK DA SCRIVERE NELL'URL PER APRIRE LA PAGINA --}}
				<a href="{{ route('admin.project.show', $project) }}" class="btn btn-info" href="#" role="button">Show</a>
				<a href="{{ route('admin.project.edit', $project) }}" class="btn btn-warning" href="#"
					role="button">Modify</a>
				<form action="{{ route('admin.project.destroy', $project->id) }}" method="POST" class="d-inline">
					@method('DELETE')
					@csrf
					<button type="submit" class="btn btn-danger">Delete</button>
				</form>
			</div>
		</div>
	@endforeach
@endsection
