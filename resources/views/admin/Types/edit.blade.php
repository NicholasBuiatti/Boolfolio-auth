@extends('layouts.admin')

@section('content')
	<div class="container-fluid mt-4">
		<div class="row justify-content-center">
			<h1 class="mb-4">Stai modificando il metodo di lavoro: {{ $type->name }}</h1>

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
				<form action="{{ route('admin.type.update', $type) }}" method="POST">
					@csrf
					@method('PATCH')

					<div class="mb-3">
						<label class="form-label">Nome:</label>
						<input class="form-control" name="name" value="{{ $type->name }}">
					</div>

					<div class="mb-3">
						<label class="form-label">Descrizione:</label>
						<input class="form-control" name="description" value="{{ $type->description }}">
					</div>
					<div class="mb-3">
						<label class="form-label">Classe di FA:</label>
						<input class="form-control" name="icon" value="{{ $type->icon }}">
					</div>

					<div class="mb-3">
						<a href="{{ route('admin.type.show', $type) }}" class="btn btn-primary">Annulla</a>
						<button type="submit" class="btn btn-primary">Salva</a>
					</div>

				</form>
			</div>

		</div>
	</div>
@endsection
