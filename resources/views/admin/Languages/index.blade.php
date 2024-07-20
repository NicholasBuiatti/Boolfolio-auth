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
						{{-- BOTTONE CHE ATTIVA IL MODALE --}}
						<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-{{ $language->id }}">
							Delete
						</button>
						{{-- MODALE DI BOOTSTRAP --}}
						<div class="modal fade text-danger" id="modal-{{ $language->id }}" tabindex="-1" data-bs-backdrop="static"
							data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitle-{{ $language->id }}" aria-hidden="true">
							<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="modalTitle-{{ $language->id }}">
											Delete current language
										</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>

									<div class="modal-body">
										Stai cancellando questo linguaggio: {{ $language->name }}
										<br>Sicuro di proseguire??
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
											Close
										</button>

										<form action="{{ route('admin.language.destroy', $language) }}" method="post">
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

	<a class="btn btn-primary" href="{{ route('admin.language.create') }}" role="button">create</a>
@endsection
