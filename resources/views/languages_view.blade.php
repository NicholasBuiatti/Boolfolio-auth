@extends('layouts.app')
@section('content')
	<h1 class="text-center mb-5">Tipologie di linguaggi, framework</h1>
	<ul>
		@foreach ($languages as $language)
			<li>
				<a href="{{ route('admin.type.show', $language) }}">{{ $language->name }}</a>
			</li>
		@endforeach

	</ul>
@endsection
