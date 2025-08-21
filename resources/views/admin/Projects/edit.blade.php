@extends('layouts.NavAdmin')

@section('content')
	<div class="container">
		<h1 class="mb-4">Modifica del progetto: {{ $project->name_project }}</h1>

		<div class="col-md-12">
			{{-- INDIVITUO SE Cè UN ERRORE E SE C'è LO STAMPO A SCHERMO --}}
			@if ($errors->any())
				<div class="alert alert-danger">
					<ul class="mb-0">
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
		</div>

		<div class="col-md-12">
			<form action="{{ route('admin.project.update', $project) }}" method="POST" enctype="multipart/form-data">
				@csrf
				@method('PATCH')
				<div class="row mb-3">

					<div class="col-6">
						<label class="form-label text-uppercase fw-bold text-decoration-underline">Titolo:</label>
						<input class="form-control @error('name_project') is-invalid @enderror" name="name_project"
							value="{{ $project->name_project }}">
					</div>

					<div class="col-6">
						<label class="form-label text-uppercase fw-bold text-decoration-underline">URL repo:</label>
						<input class="form-control @error('name_project') is-invalid @enderror" name="git_URL"
							value="{{ $project->git_URL }}">
						@error('git_URL')
							<div class="form-text text-danger">{{ $message }}</div>
						@enderror
					</div>
				</div>

				<div class="mb-3">
					<label class="form-label text-uppercase fw-bold text-decoration-underline">Descrizione:</label>
					<textarea class="form-control" name="description" rows="3">{{ old('description', $project->description) }}</textarea>
				</div>

				<div class="row mb-3">

					<div class="col-5">
						@if (Str::startsWith($project->img, 'http'))
							<img src="{{ $project->img }}" alt="" class="container-fluid">
						@else
							<img src="{{ asset('storage/' . $project->img) }}" alt="" class="container-fluid">
						@endif

					</div>
					<div class="col-5">
						<label for="img" class="form-label text-uppercase fw-bold text-decoration-underline">Cambia immagine</label>
						<input class="form-control mb-3" type="file" name="img" id="img">
						<label class="form-label text-uppercase fw-bold text-decoration-underline">Data:</label>
						<input type="date" class="form-control @error('date') is-invalid @enderror" name="date"
							value="{{ $project->date }}">
						@error('date')
							<div class="form-text text-danger">{{ $message }}</div>
						@enderror

					</div>

				</div>



				<div class="row">

					<div class="mb-3 col-3">
						<label class="form-label text-uppercase fw-bold text-decoration-underline">Tipo:</label>
						<div>
							<select name="type_id" class="form-select" autofocus>
								<option value="" class="@error('type') is-invalid @enderror" selected>{{ $project->type->name }}</option>
								@foreach ($types as $type)
									<option value="{{ $type->id }}">{{ $type->name }}</option>
								@endforeach
							</select>
						</div>
						@error('type')
							<div class="form-text text-danger">{{ $message }}</div>
						@enderror
					</div>
					<div class="mb-4 col-6">
						<label for="languages" class="col-2 form-label text-uppercase fw-bold text-decoration-underline">Linguaggi</label>
						<div class="col-md-10">
							@foreach ($languages as $language)
								<div class="form-check">
									<input class="form-check-input" type="checkbox" name="languages[]" value="{{ $language->id }}"
										id="language{{ $language->id }}" @checked(in_array($language->id, old('languages', $relations)))>
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
					<div class="col-3">
						<input type="file" multiple name="images[]" id="images">
					</div>
				</div>


				<div class="mb-3 col-3">
					<div class="form-check">
						<input class="form-check-input @error('favorite') is-invalid @enderror" type="checkbox" name='favorite'
							value="1" id="favoriteButton" @checked(old('favorite', $project->favorite))>
						<label class="form-check-label" for="favoriteButton">
							Preferito
						</label>
					</div>
					@error('favorite')
						<div class="form-text text-danger">{{ $message }}</div>
					@enderror
				</div>

				<div class="mb-3">
					<a href="{{ route('admin.project.show', $project) }}" class="btn btn-primary">Indietro</a>
					<button type="submit" class="btn btn-primary">Conferma</a>
				</div>

			</form>
		</div>

	</div>
@endsection
