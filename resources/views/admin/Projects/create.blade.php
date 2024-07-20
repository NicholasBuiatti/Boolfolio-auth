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

	<form action="{{ route('admin.project.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="mb-3">
			<label class="form-label">Titolo:</label>
			<input type="text" class="form-control @error('name_project') is-invalid @enderror" name="name_project" required>
			@error('name_project')
				<div class="form-text text-danger">{{ $message }}</div>
			@enderror
		</div>

		<div class="mb-3">
			<label class="form-label">URL repo:</label>
			<input class="form-control @error('git_URL') is-invalid @enderror" name="git_URL" required>
			@error('git_URL')
				<div class="form-text text-danger">{{ $message }}</div>
			@enderror
		</div>

		<div class="mb-3">
			<label for="img" class="form-label">Immagine:</label>
			<input class="form-control" type="file" name="img" id="img">
		</div>

		<div class="mb-3">
			<label class="form-label">Descrizione:</label>
			<textarea class="form-control" name="description" rows="3"></textarea>
		</div>

		<div class="row">
			<div class="mb-3 col-2">
				<label class="form-label">Data:</label>
				<input type="date" class="form-control @error('date') is-invalid @enderror" name="date" required>
				@error('date')
					<div class="form-text text-danger">{{ $message }}</div>
				@enderror
			</div>

			<div class="mb-3 col-3">
				<label class="form-label">Tipo:</label>
				<div>
					<select name="type_id" class="form-select @error('type') is-invalid @enderror" required autofocus>
						<option value="" selected></option>
						@foreach ($types as $type)
							<option value="{{ $type->id }}">{{ $type->name }}</option>
						@endforeach
					</select>
				</div>
				@error('type')
					<div class="form-text text-danger">{{ $message }}</div>
				@enderror
			</div>

			<div class="mb-4 row">
				<label for="languages" class="col-md-2 col-form-label text-md-right">Linguaggi</label>
				<div class="col-md-10">
					@foreach ($languages as $language)
						<div class="form-check">
							<input class="form-check-input" type="checkbox" name="languages[]" value="{{ $language->id }}"
								id="language{{ $language->id }}">
							<label class="form-check-label" for="language{{ $language->id }}">
								{{ $language->name }}
							</label>
						</div>
					@endforeach
					@error('languages')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
			</div>
		</div>

		<div class="mb-3">
			<a href="{{ route('admin.project.index') }}" class="btn btn-primary">Annulla</a>
			<button type="submit" class="btn btn-primary">Salva</a>
		</div>

	</form>
@endsection
