@extends('layouts.app')
@section('content')
	<h1 class="text-center mb-5">Front or Back? It's your choice!</h1>
	<ul>
		@foreach ($types as $type)
			<li>
				<a href="{{ route('admin.type.show', $type) }}">{{ $type->name }}</a>
			</li>
		@endforeach

	</ul>
@endsection
