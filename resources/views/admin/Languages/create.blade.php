@extends('layouts.admin')

@section('content')
	<h1>Aggiungi un nuovo Linguaggio o Framework</h1>

	@if ($errors->any())
		<div class="alert alert-danger">
			<ul class="mb-0">
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

	<form action="{{ route('admin.language.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="mb-3">
			<label class="form-label">Nome:</label>
			<input type="text" class="form-control" name="name">
		</div>

		<div class="mb-3">
			<label class="form-label">Descrizione:</label>
			<textarea class="form-control" name="description" rows="3"></textarea>
		</div>

		<div class="mb-3">
			<label class="form-label">Classe icon di FA:</label>
			<input type="text" class="form-control" name="icon">
		</div>

		<div class="mb-3">
			<a href="{{ route('admin.language.index') }}" class="btn btn-primary">Annulla</a>
			<button type="submit" class="btn btn-primary">Salva</a>
		</div>

	</form>
@endsection
