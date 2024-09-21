@extends('layouts.NavAdmin')

@section('content')
	<div class="container">

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
			<div class="row">
				<div class="col-6">
					<label class="form-label">Nome:</label>
					<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" required>
					@error('name')
						<div class="form-text text-danger">{{ $message }}</div>
					@enderror
				</div>

				<div class="col-3">
					<label class="form-label">Classe icon di FA:</label>
					<input type="text" class="form-control" name="icon">
				</div>

			</div>

			<div class="mb-3 col-9">
				<label class="form-label">Descrizione:</label>
				<textarea class="form-control" name="description" rows="3"></textarea>
			</div>

			<div class="mb-3">
				<a href="{{ route('admin.language.index') }}" class="btn btn-primary">Indietro</a>
				<button type="submit" class="btn btn-primary">Salva</a>
			</div>

		</form>
	</div>
@endsection
