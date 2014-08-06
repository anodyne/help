<!DOCTYPE html>
<html lang="en" ng-app="helpApp">
	<head>
		<meta charset="utf-8">
		<title>@yield('title') &bull; Anodyne Help Center</title>
		<meta name="description" content="The Anodyne Help Center is a knowledge base for information and articles relating to the services and products offered by Anodyne Productions.">
		<meta name="author" content="Anodyne Productions">
		<meta name="viewport" content="width=device-width">
		<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico?v1') }}">
		<link rel="apple-touch-icon-precomposed" href="{{ asset('apple-touch-icon.png') }}">

		<!--[if lt IE 9]>
		{{ HTML::script('js/html5shiv.js') }}
		<![endif]-->

		@if (App::environment() == 'production')
			<link href="//fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
			<link href="//fonts.googleapis.com/css?family=Bitter:400,700" rel="stylesheet">
			<link href="//fonts.googleapis.com/css?family=Exo+2:500,500italic,600,600italic" rel="stylesheet">
			<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
		@else
			<link href="//localhost/global/bootstrap/3.2/css/bootstrap.min.css" rel="stylesheet">
		@endif
		{{ HTML::style('css/style.css') }}
		{{ HTML::style('css/fonts.css') }}
		@yield('styles')
	</head>
	<body>
		<div class="wrapper">
			<nav class="nav-main">
				<div class="container">
					<ul class="pull-right">
						<li><a href="#" class="js-contact">Contact</a></li>

						@if (Auth::check())
							<li class="dropdown">
								<a href="#" data-toggle="dropdown" class="dropdown-toggle"><span class="user-icon">{{ $_icons['user'] }}</span> {{ $_currentUser->present()->name }} <span class="caret"></span></a>
								<ul class="dropdown-menu dropdown-menu-right dd">
									@if ($_currentUser->can('help.article.create'))
										<li><a href="{{ route('article.create') }}">Create New Article</a></li>
										<li class="divider"></li>
									@endif
									<li><a href="{{ route('account.profile', [$_currentUser->slug]) }}">My Profile</a></li>
									<li><a href="{{ route('account.edit', [$_currentUser->slug]) }}">Edit My Profile</a></li>

									@if ($_currentUser->can('help.admin'))
										<li class="divider"></li>
										<li><a href="{{ route('admin') }}">Admin</a></li>
									@endif

									<li class="divider"></li>
									<li><a href="{{ route('logout') }}">Logout</a></li>
								</ul>
							</li>
						@else
							<li><a href="{{ route('login') }}">Log In</a></li>
						@endif
					</ul>

					<ul>
						<li><a href="http://anodyne-productions.com">Anodyne<div class="arrow"></div></a></li>
						<li><a href="http://anodyne-productions.com/nova">Nova<div class="arrow"></div></a></li>
						<li><a href="http://xtras.anodyne-productions.com">Xtras<div class="arrow"></div></a></li>
						<li><a href="http://forums.anodyne-productions.com">Forums<div class="arrow"></div></a></li>
						<li><a href="{{ route('home') }}" class="active">Help<div class="arrow"></div></a></li>
						<!--<li><a href="http://learn.anodyne-productions.com">Learn<div class="arrow"></div></a></li>
						<li><a href="http://docs.anodyne-productions.com">Docs<div class="arrow"></div></a></li>-->
					</ul>
				</div>
			</nav>

			<header>
				<div class="container">
					<div class="row">
						<div class="col-md-4">
							<a href="{{ route('home') }}" class="brand">Anodyne Help Center</a>
						</div>

						<div class="col-md-4">
							<nav class="nav-sub">
								<ul>
									<li><a href="#">Nova 2</a></li>
									<li><a href="#">Nova 3</a></li>
								</ul>
							</nav>
						</div>

						<div class="col-md-4">
							{{ Form::open(['route' => 'search.do']) }}
								<div class="header-search">
									<div class="input-group">
										{{ Form::text('search', null, ['placeholder' => 'Search the Help Center', 'class' => 'input-sm form-control search-field']) }}
										<span class="input-group-btn">{{ Form::button('Search', ['class' => 'btn btn-default btn-sm', 'type' => 'submit']) }}</span>
									</div>
									<a href="{{ route('search.advanced') }}" class="search-advanced">Advanced Search</a>
								</div>
							{{ Form::close() }}
						</div>
					</div>
				</div>
			</header>

			<section>
				<div class="container">
					@if (Session::has('flash.message'))
						@include('partials.alert')
					@endif

					@yield('content')
				</div>
			</section>

			<div class="push"></div>
		</div>

		<footer>
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<h2>Anodyne Help Center</h2>

						<p class="text-muted">Every game is unique; it has its own players, characters, missions, and driving force. Why shouldn't each game accurately reflect its distinctiveness through its look and feel and functionality? We've created AnodyneXtras as a one-stop-shop for skins, MODs, and rank sets for Nova so you can make your version of Nova as unique as the game being played with it.</p>

						<p class="text-muted">&copy; {{ Date::now()->year }} Anodyne Productions</p>
					</div>
					<div class="col-md-2">
						<ul class="list-unstyled">
							<li><a href="{{ route('home') }}">Home</a></li>

							@if (Auth::check())
								<li><a href="#">My Xtras</a></li>
								<li><a href="#">Skins</a></li>
								<li><a href="#">Ranks</a></li>
								<li><a href="#">MODs</a></li>
							@endif
						</ul>
					</div>
					<div class="col-md-2">
						<ul class="list-unstyled">
							<li><a href="#">Site Policies</a></li>
							<li><a href="#">FAQs</a></li>
							<li><a href="#" class="js-contact">Contact</a></li>
							<li><a href="http://anodyne-productions.com">Anodyne</a></li>
						</ul>
					</div>
				</div>
			</div>
		</footer>

		{{ modal(['id' => 'contactModal', 'header' => "Contact Anodyne"]) }}
		@yield('modals')

		@if (App::environment() == 'production')
			<!--[if lt IE 9]>
				<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
			<![endif]-->
			<!--[if gte IE 9]><!-->
				<script src="//code.jquery.com/jquery-2.1.1.min.js"></script>
			<!--<![endif]-->

			<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
			<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js"></script>
			<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/additional-methods.min.js"></script>
		@else
			<!--[if lt IE 9]>
				<script src="//localhost/global/jquery/jquery-1.11.1.min.js"></script>
			<![endif]-->
			<!--[if gte IE 9]><!-->
				<script src="//localhost/global/jquery/jquery-2.1.1.min.js"></script>
			<!--<![endif]-->

			<script src="//localhost/global/bootstrap/3.2/js/bootstrap.min.js"></script>
			<script src="//localhost/global/jquery.validate/1.13/jquery.validate.min.js"></script>
			<script src="//localhost/global/jquery.validate/1.13/additional-methods.min.js"></script>
		@endif
		{{ HTML::script('js/app.js') }}
		<script>
			// Destroy all modals when they're hidden
			$('.modal').on('hidden.bs.modal', function()
			{
				$('.modal').removeData('bs.modal');
			});

			$('.js-contact').on('click', function(e)
			{
				e.preventDefault();

				var contactUrl = "http://localhost/anodyne/www/public/contact";

				@if (App::environment() == 'production')
					contactUrl = "http://anodyne-productions.com/contact";
				@endif

				$('#contactModal').modal({
					remote: contactUrl
				}).modal('show');
			});

			$(document).ready(function()
			{
				$('.tooltip-bottom').tooltip({ position: "bottom" });
				$('.tooltip-top').tooltip({ position: "top" });
			});
		</script>
		@yield('scripts')
	</body>
</html>