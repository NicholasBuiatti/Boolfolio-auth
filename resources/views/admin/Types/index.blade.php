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
						<a class="btn btn-secondary" href="#" role="button">Modify</a>
						<a class="btn btn-danger" href="#" role="button">Delete</a>
					</div>
				</div>
			</div>
		@endforeach
	</div>

	<a class="btn btn-primary" href="{{ route('admin.type.create') }}" role="button">create</a>
@endsection
