@extends('layouts.admin')

@section('content')
	<div class="container-fluid mt-4">
		<div class="row justify-content-center">
			<h1 class="mb-4">Stai modificando il progetto: {{ $project->name_project }}</h1>

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

					<div class="mb-3">
						<label class="form-label">Titolo:</label>
						<input class="form-control @error('name_project') is-invalid @enderror" name="name_project"
							value="{{ $project->name_project }}">
					</div>

					<div class="mb-3">
						<label class="form-label">URL repo:</label>
						<input class="form-control @error('name_project') is-invalid @enderror" name="git_URL"
							value="{{ $project->git_URL }}">
						@error('git_URL')
							<div class="form-text text-danger">{{ $message }}</div>
						@enderror
					</div>

					<div class="mb-3">

						<label for="img" class="form-label">File immagine:</label>
						@if (Str::startsWith($project->img, 'http'))
							<img width="140" src="{{ $project->img }}" alt="">
						@else
							<img width="140" src="{{ asset('storage/' . $project->img) }}" alt="">
						@endif
						<input class="form-control" type="file" name="img" id="img">
					</div>

					<div class="mb-3">
						<label class="form-label">Descrizione:</label>
						<input class="form-control" name="description" value="{{ $project->description }}">
					</div>

					<div class="row">
						<div class="mb-3 col-2">
							<label class="form-label">Data:</label>
							<input type="date" class="form-control @error('date') is-invalid @enderror" name="date"
								value="{{ $project->date }}">
							@error('date')
								<div class="form-text text-danger">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-3 col-3">
							<label class="form-label">Tipo:</label>
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
					</div>

					<div class="mb-4 row">
						<label for="languages" class="col-md-2 col-form-label text-md-right">Linguaggi</label>
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
						<a href="{{ route('admin.project.show', $project) }}" class="btn btn-primary">Annulla</a>
						<button type="submit" class="btn btn-primary">Salva</a>
					</div>

				</form>
			</div>

		</div>
	</div>
@endsection
