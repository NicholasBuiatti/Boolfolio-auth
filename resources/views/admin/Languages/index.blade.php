@extends('layouts.NavAdmin')

@section('content')
	<div class="container">
		<div class="row justify-content-between">
			<h1 class="col">Ecco la lista dei linguaggi o Framework usati</h1>
			<div class="col-2 d-flex align-items-center justify-content-end">
				<a class="btn btn-dark text-dark" id="btnCreate" href="{{ route('admin.language.create') }}" role="button">Aggiungi</a>
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
				@foreach ($languages as $language)
					<tr class="text-center align-middle">
						<td>
							<i class="{{ $language->icon }} fs-2"></i>
						</td>
						<td>
							<h5 class="fs-3">{{ $language->name }}</h5>
						</td>
						<td>
							<p>{{ $language->description }}</p>
						</td>

						<td>
							{{-- RIPORTO IN ROUTE IL LINK DA SCRIVERE NELL'URL PER APRIRE LA PAGINA --}}

							<a href="{{ route('admin.language.edit', $language->id) }}" class="btn border" id="btnEdit" role="button">
								<i class="fa-solid fa-pen"></i>
							</a>
							{{-- BOTTONE CHE ATTIVA IL MODALE  --}}
							<button type="button" class="btn border" id="btnDelete" data-bs-toggle="modal"
								data-bs-target="#modal-{{ $language->id }}">
								<i class="fa-solid fa-trash"></i>
							</button>
							{{-- MODALE DI BOOTSTRAP  --}}
							<div class="modal fade text-danger" id="modal-{{ $language->id }}" tabindex="-1" data-bs-backdrop="static"
								data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitle-{{ $language->id }}" aria-hidden="true">
								<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="modalTitle-{{ $language->id }}">
												Delete current project
											</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>

										<div class="modal-body">
											Stai cancellando il progetto: {{ $language->name }}
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
@endsection
