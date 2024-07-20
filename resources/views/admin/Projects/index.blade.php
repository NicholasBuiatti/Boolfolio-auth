@extends('layouts.admin')

@section('content')
	<h1 class="text-center mb-3">PROGETTI:</h1>
	{{ $projects->links('pagination::bootstrap-5') }}
	@foreach ($projects as $project)
		<div class="card bg-dark text-white mb-4" style="height: 20rem">
			<img
				src="{{ $project->img = Str::startsWith($project->img, 'https') ? $project->img : asset('storage/' . $project->img) }}"
				class="card-img object-fit-cover" style="height: 20rem">
			<div class="card-img-overlay">
				<h5 class="card-title">Titolo: {{ $project->name_project }}</h5>
				<p class="card-text">Data: {{ $project->date }}</p>
				<a href="{{ $project->git_URL }}" class="card-text">Git Link</a>
				<p>linguaggio
				<ul>
					@foreach ($project->languages as $language)
						<li>{{ $language->name }}</li>
					@endforeach
				</ul>

				</p>
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
	@endforeach
@endsection
