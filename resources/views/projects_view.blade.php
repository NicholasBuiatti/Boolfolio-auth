@extends('layouts.app')
@section('content')
	<h1 class="text-center mb-5">Ecco la lista di tutti i progetti</h1>
	@foreach ($projects as $project)
		<div class="card bg-dark text-white mb-4" style="height: 15rem">
			<img src="{{ asset('storage/' . $project->img) }}" class="card-img object-fit-cover" style="height: 15rem">
			<div class="card-img-overlay">
				<h5 class="card-title">Titolo: {{ $project->name_project }}</h5>
				<p class="card-text">Data: {{ $project->date }}</p>
				{{-- RIPORTO IN ROUTE IL LINK DA SCRIVERE NELL'URL PER APRIRE LA PAGINA --}}
				<a href="{{ route('admin.project.show', $project) }}" class="btn btn-info" href="#" role="button">Show</a>
			</div>
		</div>
	@endforeach
@endsection
