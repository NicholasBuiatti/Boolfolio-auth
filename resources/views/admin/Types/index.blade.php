@extends('layouts.admin')

@section('content')
	<h1 class="text-center mb-5">Front or Back? It's your choice!</h1>
	<div class="row">
		@foreach ($types as $type)
			<div class="col-3">
				<div class="card">
					<div class="card-body">
						<h2 class="card-title">
							<a href="{{ route('admin.type.show', $type) }}">{{ $type->name }}</a>
						</h2>
						<a class="btn btn-secondary" href="{{ route('admin.type.edit', $type->id) }}" role="button">Modify</a>
						<form action="{{ route('admin.type.destroy', $type->id) }}" method="POST" class="d-inline">
							@method('DELETE')
							@csrf
							<button type="submit" class="btn btn-danger">Delete</button>
						</form>
					</div>
				</div>
			</div>
		@endforeach
	</div>

	<a class="btn btn-primary" href="{{ route('admin.type.create') }}" role="button">create</a>
@endsection
