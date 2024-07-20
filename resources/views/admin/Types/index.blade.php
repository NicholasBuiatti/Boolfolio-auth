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
						{{-- BOTTONE CHE ATTIVA IL MODALE --}}
						<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-{{ $type->id }}">
							Delete
						</button>
						{{-- MODALE DI BOOTSTRAP --}}
						<div class="modal fade text-danger" id="modal-{{ $type->id }}" tabindex="-1" data-bs-backdrop="static"
							data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitle-{{ $type->id }}" aria-hidden="true">
							<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="modalTitle-{{ $type->id }}">
											Delete current type
										</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>

									<div class="modal-body">
										Stai cancellando il tipo di lavoro: {{ $type->name }}
										<br>Sicuro di proseguire??
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
											Close
										</button>

										<form action="{{ route('admin.type.destroy', $type) }}" method="post">
											@csrf
											@method('DELETE')

											<button type="submit" class="btn btn-danger">
												Confirm
											</button>

										</form>


									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endforeach
	</div>

	<a class="btn btn-primary" href="{{ route('admin.type.create') }}" role="button">create</a>
@endsection
