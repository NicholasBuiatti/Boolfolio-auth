@extends('layouts.NavAdmin')

@section('content')
	<div class="row justify-content-between">
		<h1 class="col-6">Lista Progetti:</h1>

		<div class="col-2 d-flex align-items-center justify-content-end">
			<a class="btn btn-dark text-dark" id="btnCreate" href="{{ route('admin.project.create') }}">
				Nuovo progetto
			</a>
		</div>
	</div>
	<table class="table caption-top">
		<thead>
			<tr class="text-center">
				<th scope="col">IMMAGINE</th>
				<th scope="col" class="text-start">NOME PROGETTO</th>
				<th scope="col">DATA</th>
				<th scope="col">PREFERITO</th>
				<th scope="col">AZIONI</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($projects as $project)
				<tr class="text-center align-middle">
					<td style="width: 14rem;">
						<img
							src="{{ $project->img = Str::startsWith($project->img, 'https') ? $project->img : asset('storage/' . $project->img) }}"
							class="shadow" style="height: 6rem; width:12rem; object-fit: cover;" alt="immagine-progetto">

					</td>
					<td class="text-start">
						<h5 class="fs-3">{{ $project->name_project }}</h5>
					</td>
					<td>
						<p>{{ $project->date }}</p>
					</td>
					<td>
						@if ($project->favorite == true)
							<i class="fa-solid fa-heart text-danger fs-5"></i>
						@else
							<i class="fa-regular fa-heart text-danger fs-5"></i>
						@endif
					</td>
					<td>
						<form action="{{ route('admin.project.visibility', $project->id) }}" method="POST" class="d-inline">
        					@csrf
        					@method('PATCH')
        					<input type="hidden" name="visible" value="{{ $project->visible ? 0 : 1 }}">
        					<button type="submit" class="btn btn-sm {{ $project->visible ? 'btn-success' : 'btn-secondary' }}">
        					    {{ $project->visible ? 'Visibile' : 'Nascosto' }}
        					</button>
    					</form>
					</td>
					<td>
						{{-- RIPORTO IN ROUTE IL LINK DA SCRIVERE NELL'URL PER APRIRE LA PAGINA --}}
						<a href="{{ route('admin.project.show', $project) }}" class="btn border" id="btnShow" href="#"
							role="button">
							<i class="fa-solid fa-magnifying-glass"></i>
						</a>
						<a href="{{ route('admin.project.edit', $project) }}" class="btn border" id="btnEdit" href="#"
							role="button">
							<i class="fa-solid fa-pen"></i>
						</a>
						{{-- BOTTONE CHE ATTIVA IL MODALE  --}}
						<button type="button" class="btn border" id="btnDelete" data-bs-toggle="modal"
							data-bs-target="#modal-{{ $project->id }}">
							<i class="fa-solid fa-trash"></i>
						</button>
						{{-- MODALE DI BOOTSTRAP  --}}
						<div class="modal fade text-danger" id="modal-{{ $project->id }}" tabindex="-1" data-bs-backdrop="static"
							data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitle-{{ $project->id }}" aria-hidden="true">
							<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="modalTitle-{{ $project->id }}">
											Delete current project
										</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>

									<div class="modal-body">
										Stai cancellando il progetto: {{ $project->name_project }}
										<br>Sicuro di proseguire??
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
											Close
										</button>

										<form action="{{ route('admin.project.destroy', $project) }}" method="post">
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
	{{ $projects->links('pagination::bootstrap-5') }}

	<style>
		#btnCreate {
			background-color: #F8F7F2;
		}

		#btnShow {
			background-color: #F0F8FF;
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

		#btnShow:hover {
			background-color: #D6E6F2;
		}

		#btnEdit:hover {
			background-color: #F5B895;
		}

		#btnDelete:hover {
			background-color: #E57373;
		}
	</style>
@endsection
