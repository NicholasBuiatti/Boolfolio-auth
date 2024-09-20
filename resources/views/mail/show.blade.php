@extends('layouts.NavAdmin')

@section('content')
	<div class="container">
		<a class="btn mb-2" id="btnCreate" href="{{ route('admin.messages.index') }}"><i class="fa-solid fa-arrow-left"></i> Lista
			messaggi</a>
		<div class="row">
			<div class="col-6 mb-2">
				<div class="card">
					<div class="card-header">
						{{ $message->email }}
					</div>
					<div class="card-body">
						<blockquote class="blockquote mb-0">
							<p>{{ $message->message }}</p>
							<footer class="blockquote-footer">{{ $message->name }}</footer>
						</blockquote>
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
