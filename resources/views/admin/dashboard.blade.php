@extends('layouts.NavAdmin')

@section('content')
	<div class="container">

		<div class="row mb-4">
			<div class="col-6">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<h3 class="card-title col-9">Progetti preferiti:</h3>
							<a href="{{ route('admin.project.index') }}" id='btnCreate' class="btn text-black col-3">Vai all Lista</a>
						</div>
						@foreach ($projects as $project)
							<p class="card-text">{{ $project->name_project }}</p>
							<footer class="blockquote-footer border-bottom">{{ $project->date }}</footer>
						@endforeach
					</div>
				</div>
			</div>
			<div class="col-6">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<h3 class="card-title col-9">Messaggi:</h3>
							<a href="{{ route('admin.messages.index') }}" id='btnCreate' class="btn text-black col-3">Vai all Lista</a>
						</div>
						@foreach ($messages as $message)
							<p class="card-text">{{ $message->email }}</p>
							<footer class="blockquote-footer border-bottom">{{ $message->name }}</footer>
						@endforeach
					</div>
				</div>
			</div>
		</div>

	</div>
	<style>
		#btnCreate {
			background-color: #F8F7F2;
			border: 2px solid #EDEAE0;
		}

		#btnCreate:hover {
			background-color: #EDEAE0;
		}
	</style>
@endsection
