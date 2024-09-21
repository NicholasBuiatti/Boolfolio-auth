@extends('layouts.NavAdmin')

@section('content')
	<div class="container">
		<div class="row justify-content-between">
			<h1 class="col">Tipologia di progetto</h1>
			<div class="col-2 d-flex align-items-center justify-content-end">
				<a class="btn btn-dark text-dark" id="btnCreate" href="{{ route('admin.type.create') }}" role="button">Aggiungi</a>
			</div>
		</div>
		<table class="table caption-top">
			<thead>
				<tr class="text-center">
					<th scope="col">ICONA</th>
					<th scope="col">NOME</th>
					<th scope="col">DESCRIZIONE</th>
					<th scope="col">AZIONI</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($types as $type)
					<tr class="text-center align-middle">
						<td>
							<i class="{{ $type->icon }} fs-2"></i>
						</td>
						<td>
							<h5 class="fs-3">{{ $type->name }}</h5>
						</td>
						<td>
							<p>{{ $type->description }}</p>
						</td>

						<td>
							{{-- RIPORTO IN ROUTE IL LINK DA SCRIVERE NELL'URL PER APRIRE LA PAGINA --}}

							<a href="{{ route('admin.type.edit', $type->id) }}" class="btn border" id="btnEdit" role="button">
								<i class="fa-solid fa-pen"></i>
							</a>
							{{-- BOTTONE CHE ATTIVA IL MODALE  --}}
							<button type="button" class="btn border" id="btnDelete" data-bs-toggle="modal"
								data-bs-target="#modal-{{ $type->id }}">
								<i class="fa-solid fa-trash"></i>
							</button>
							{{-- MODALE DI BOOTSTRAP  --}}
							<div class="modal fade text-danger" id="modal-{{ $type->id }}" tabindex="-1" data-bs-backdrop="static"
								data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitle-{{ $type->id }}" aria-hidden="true">
								<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="modalTitle-{{ $type->id }}">
												Delete current project
											</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>

										<div class="modal-body">
											Stai cancellando il progetto: {{ $type->name }}
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
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<style>
		#btnCreate {
			background-color: #F8F7F2;
		}

		#btnEdit {
			background-color: #FFE5B4;
		}

		#btnDelete {
			background-color: #FAD4D4;
		}

		#btnCreate:hover {
			background-color: #EDEAE0;
		}

		#btnEdit:hover {
			background-color: #F5B895;
		}

		#btnDelete:hover {
			background-color: #E57373;
		}
	</style>
	{{-- <div class="row">
		@foreach ($types as $type)
			<div class="card col-3 text-center">
				<div class="card-body">
					<h2 class="card-title">
						<a href="{{ route('admin.type.show', $type) }}"
							class="link-underline link-underline-opacity-0">{{ $type->name }}</a>
					</h2>
					<a class="btn btn-secondary" href="{{ route('admin.type.edit', $type->id) }}" role="button">M</a>
					{{-- BOTTONE CHE ATTIVA IL MODALE
					<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-{{ $type->id }}">
						D
					</button>
					{{-- MODALE DI BOOTSTRAP
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
		@endforeach
	</div> --}}
@endsection
