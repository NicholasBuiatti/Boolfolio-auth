@extends('layouts.admin')

@section('content')
	<h1 class="text-center mb-3">PROGETTI:</h1>
	{{ $projects->links('pagination::bootstrap-5') }}
	<div class="row row-cols-1 row-cols-md-2 g-4">
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

						{{-- RIPORTO IN ROUTE IL LINK DA SCRIVERE NELL'URL PER APRIRE LA PAGINA --}}
						<a href="{{ route('admin.project.show', $project) }}" class="btn btn-info" href="#" role="button">Show</a>
						<a href="{{ route('admin.project.edit', $project) }}" class="btn btn-warning" href="#"
							role="button">Modify</a>

						{{-- BOTTONE CHE ATTIVA IL MODALE --}}
						<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-{{ $project->id }}">
							Delete
						</button>
						{{-- MODALE DI BOOTSTRAP --}}
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
		@endforeach
	@endsection
