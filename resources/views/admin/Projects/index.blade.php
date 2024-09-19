@extends('layouts.NavAdmin')

@section('content')
	<table class="table caption-top">
		<caption>
			<h1>Lista Progetti:</h1>
		</caption>
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
							class="border border-3 border-dark" style="height: 6rem; width:12rem; object-fit: cover;" alt="immagine-progetto">
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
						{{-- RIPORTO IN ROUTE IL LINK DA SCRIVERE NELL'URL PER APRIRE LA PAGINA --}}
						<a href="{{ route('admin.project.show', $project) }}" class="btn btn-info" href="#" role="button">
							<i class="fa-solid fa-magnifying-glass"></i>
						</a>
						<a href="{{ route('admin.project.edit', $project) }}" class="btn btn-warning" href="#" role="button">
							<i class="fa-solid fa-pen"></i>
						</a>
						{{-- BOTTONE CHE ATTIVA IL MODALE  --}}
						<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-{{ $project->id }}">
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
	{{-- <div class="row row-cols-1 row-cols-md-2 g-4">
		@foreach ($projects as $project)
			<div class="col">
				<div class="card">
					<img
						src="{{ $project->img = Str::startsWith($project->img, 'https') ? $project->img : asset('storage/' . $project->img) }}"
						class="card-img-top object-fit-cover" alt="...">
					<div class="card-body">
						<h5 class="card-title">Titolo: {{ $project->name_project }}
							@if ($project->favorite == true)
								<i class="fa-solid fa-star"></i>
							@else
								<i class="fa-regular fa-star"></i>
							@endif
						</h5>
						<p class="card-text">Data: {{ $project->date }}</p>
						<a href="{{ $project->git_URL }}" class="card-text">Git Link</a>
						<p>linguaggio
						<ul>
							@foreach ($project->languages as $language)
								<li>
									<i class="{{ $language->icon }}"></i>
									{{ $language->name }}
								</li>
							@endforeach
						</ul>

						{{-- RIPORTO IN ROUTE IL LINK DA SCRIVERE NELL'URL PER APRIRE LA PAGINA
						<a href="{{ route('admin.project.show', $project) }}" class="btn btn-info" href="#" role="button">Show</a>
						<a href="{{ route('admin.project.edit', $project) }}" class="btn btn-warning" href="#"
							role="button">Modify</a>

						{{-- BOTTONE CHE ATTIVA IL MODALE 
						<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-{{ $project->id }}">
							Delete
						</button>
						{{-- MODALE DI BOOTSTRAP 
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
					</div>
				</div>
			</div>
		@endforeach --}}
	{{ $projects->links('pagination::bootstrap-5') }}
@endsection
