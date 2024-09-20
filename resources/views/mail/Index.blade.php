@extends('layouts.NavAdmin')

@section('content')
	<div class="container">
		<div class="row justify-content-around">
			<div class="col-5">
				<div class="card">
					<div class="card-header">
						email
					</div>
					<div class="card-body">
						<blockquote class="blockquote mb-0">
							<p>testo.</p>
							<footer class="blockquote-footer">Nome</footer>
						</blockquote>
					</div>
				</div>
			</div>
			<div class="col-5">
				<div class="card">
					<div class="card-header">
						Quote
					</div>
					<div class="card-body">
						<blockquote class="blockquote mb-0">
							<p>A well-known quote, contained in a blockquote element.</p>
							<footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
						</blockquote>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
