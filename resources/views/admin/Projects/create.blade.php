@extends('layouts.admin')

@section('content')
	<h1>Aggiungi un nuovo progetto</h1>

	@if ($errors->any())
		<div class="alert alert-danger">
			<ul class="mb-0">
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

	<form action="{{ route('admin.project.store') }}" method="POST">
		@csrf

		<div class="mb-3">
			<label class="form-label">Titolo:</label>
			<input type="text" class="form-control" name="name_project">
		</div>

		<div class="mb-3">
			<label class="form-label">Descrizione:</label>
			<textarea class="form-control" name="description" rows="3"></textarea>
		</div>

		<div class="mb-3">
			<label class="form-label">Data:</label>
			<input type="date" class="form-control" name="date">
		</div>

		<div class="mb-3">
			<a href="{{ route('admin.project.index') }}" class="btn btn-primary">Annulla</a>
			<button type="submit" class="btn btn-primary">Salva</a>
		</div>

	</form>
@endsection
