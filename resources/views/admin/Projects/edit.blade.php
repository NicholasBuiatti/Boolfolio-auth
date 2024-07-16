@extends('layouts.admin')

@section('content')
	<div class="container-fluid mt-4">
		<div class="row justify-content-center">

			<div class="col-md-12">
				<h1 class="pb-4">{{ $project->name }}</h1>

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
				<form action="{{ route('admin.project.update', $project) }}" method="POST">
					@csrf
					@method('PATCH')

					<div class="mb-3">
						<label class="form-label">Titolo:</label>
						<input class="form-control" name="name_project" value="{{ $project->name_project }}">
					</div>

					<div class="mb-3">
						<label class="form-label">URL immagine:</label>
						<input class="form-control" name="img" value="{{ $project->img }}">
					</div>

					<div class="mb-3">
						<label class="form-label">Descrizione:</label>
						<input class="form-control" name="description" value="{{ $project->description }}">
					</div>

					<div class="row">
						<div class="mb-3 col-2">
							<label class="form-label">Data:</label>
							<input type="date" class="form-control" name="date" value="{{ $project->date }}">
						</div>

						<div class="mb-3 col-3">
							<label class="form-label">Tipo:</label>
							<div>
								<select name="type_id" class="form-select @error('type_id') is-invalid @enderror" required autofocus>
									<option value="" selected></option>
									@foreach ($types as $type)
										<option value="{{ $type->id }}">{{ $type->name }}</option>
									@endforeach
								</select>
								@error('type_id')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
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
