@extends('layouts.admin')

@section('content')
	<h1 class="text-center mb-5">Ecco la lista dei linguaggi o Framework usati</h1>
	<div class="row">
		@foreach ($languages as $language)
			<div class="col-3">
				<div class="card">
					<div class="card-body">
						<h2 class="card-title">
							<a href="{{ route('admin.language.show', $language) }}">{{ $language->name }}</a>
						</h2>
						<a class="btn btn-secondary" href="{{ route('admin.language.edit', $language->id) }}" role="button">Modify</a>
						<form action="{{ route('admin.language.destroy', $language->id) }}" method="POST" class="d-inline">
							@method('DELETE')
							@csrf
							<button type="submit" class="btn btn-danger">Delete</button>
						</form>
					</div>
				</div>
			</div>
		@endforeach
	</div>

	<a class="btn btn-primary" href="{{ route('admin.language.create') }}" role="button">create</a>
@endsection
