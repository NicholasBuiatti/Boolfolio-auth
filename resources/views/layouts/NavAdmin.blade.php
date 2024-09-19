<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Fontawesome 6 cdn -->
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css'
		integrity='sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=='
		crossorigin='anonymous' referrerpolicy='no-referrer' />

	<!-- Fonts -->
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

	<!-- Usando Vite -->
	@vite(['resources/js/app.js'])
</head>

<body>
	<div id="app">

		<div class="container-fluid vh-100">
			<div class="row h-100">
				<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse border-end border-secondary"
					style="background-color: #f8f5e1;">
					<div class="position-sticky pt-3 h-100 d-flex flex-column justify-content-between">
						<div>
							<div class="logo_laravel text-center">
								<img src="{{ asset('NBPortfolioLogo.png') }}" class="img-fluid w-50" alt="">
							</div>
							<hr>
							<ul class="nav flex-column">
								<li class="nav-item">
									<a class="nav-link text-dark {{ Route::currentRouteName() == 'admin.dashboard' ? 'bg-secondary' : '' }}"
										href="{{ route('admin.dashboard') }}">
										<i class="fa-solid fa-tachometer-alt fa-lg fa-fw"></i> Dashboard
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link text-dark {{ Route::currentRouteName() == 'admin.project.index' ? 'bg-secondary' : '' }}"
										href="{{ route('admin.project.index') }}">
										<i class="fa-solid fa-table-list fa-lg fa-fw"></i> Projects
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link text-dark {{ Route::currentRouteName() == 'admin.project.create' ? 'bg-secondary' : '' }}"
										href="{{ route('admin.project.create') }}">
										<i class="fa-solid fa-plus fa-lg fa-fw"></i> Import New Project
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link text-dark {{ Route::currentRouteName() == 'admin.type.index' ? 'bg-secondary' : '' }}"
										href="{{ route('admin.type.index') }}">
										<i class="fa-solid fa-keyboard fa-lg fa-fw"></i> Types of Works
									</a>
								</li>
							</ul>
						</div>
						<div class="mb-3">
							<hr>
							<div class="dropdown text-center">
								<a id="navbarDropdown" class="nav-link dropdown-toggle text-dark" href="#" role="button"
									data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
									<i class="fa-solid fa-circle-user fs-2 me-3 align-middle"></i>{{ Auth::user()->email }}
								</a>
								<ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
									<li><a class="dropdown-item" href="{{ url('/') }}">{{ __('Home') }}</a></li>
									<li><a class="dropdown-item" href="{{ url('profile') }}">{{ __('Profilo') }}</a></li>
									<li>
										<hr class="dropdown-divider">
									</li>
									<li><a class="dropdown-item" href="{{ route('logout') }}"
											onclick="event.preventDefault();
													 document.getElementById('logout-form').submit();">
											{{ __('Disconnetti') }}
										</a></li>
									<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
										@csrf
									</form>
								</ul>
							</div>
						</div>
					</div>
				</nav>

				<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 overflow-auto py-4" style="height: 100vh">
					@yield('content')
				</main>
			</div>
		</div>
	</div>
</body>

</html>
