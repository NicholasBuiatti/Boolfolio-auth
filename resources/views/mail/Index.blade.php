@extends('layouts.NavAdmin')

@section('content')
	<div class="container">
		<h1>Messaggi</h1>
		<div class="row">
			@foreach ($messages as $message)
				<a href="{{ route('admin.message.show', $message) }}" class="col-6 mb-2 text-decoration-none">
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
				</a>
			@endforeach
		</div>
	</div>
@endsection
