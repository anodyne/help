<!DOCTYPE html>
<html lang="en">
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

		{{ partial('global_styles') }}
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
									<li><a href="{{ route('account.profile', [$_currentUser->username]) }}">My Profile</a></li>
									<li><a href="{{ Config::get('anodyne.links.www') }}admin/users/{{ $_currentUser->username }}/edit">Edit My Profile</a></li>

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
						<li><a href="{{ Config::get('anodyne.links.www') }}">Anodyne<div class="arrow"></div></a></li>
						<li><a href="{{ Config::get('anodyne.links.nova') }}">Nova<div class="arrow"></div></a></li>
						<li><a href="{{ Config::get('anodyne.links.xtras') }}">Xtras<div class="arrow"></div></a></li>
						<li><a href="{{ Config::get('anodyne.links.forums') }}">Forums<div class="arrow"></div></a></li>
						<li><a href="{{ route('home') }}" class="active">Help<div class="arrow"></div></a></li>
					</ul>
				</div>
			</nav>

			<header>
				<div class="container">
					<div class="row">
						<div class="col-md-4">
							<a href="{{ route('home') }}" class="brand">Anodyne Help Center</a>
						</div>

						<div class="col-md-8">
							<nav class="nav-sub">
								<ul>
									<li><a href="{{ route('product', ['nova-1']) }}">Nova 1</a></li>
									<li><a href="{{ route('product', ['nova-2']) }}">Nova 2</a></li>
									<!--<li><a href="{{ route('product', ['nova-3']) }}">Nova 3</a></li>-->
									<li><a href="{{ route('product', ['anodynextras']) }}">AnodyneXtras</a></li>
									<li><a href="{{ route('search.advanced') }}">Advanced Search</a></li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</header>

			<div class="search-help">
				<div class="container">
					{{ Form::open(['route' => 'search.do']) }}
					<div class="row">
						<div class="col-xs-12">
							<div class="input-group">
								<span class="input-group-addon">{{ $_icons['search-lg'] }}</span>
								{{ Form::text('search', null, ['placeholder' => 'Search the Help Center', 'class' => 'input-lg form-control search-field']) }}
							</div>
						</div>
					</div>
					{{ Form::close() }}
				</div>
			</div>

			<section>
				<div class="container">
					@if (Session::has('flash.message'))
						@include('partials.flash')
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

		{{ partial('global_scripts') }}
		<script>
			// Destroy all modals when they're hidden
			$('.modal').on('hidden.bs.modal', function()
			{
				$('.modal').removeData('bs.modal');
			});

			$('.js-contact').on('click', function(e)
			{
				e.preventDefault();

				var contactUrl = "{{ config('anodyne.links.www') }}contact";

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
		@if (App::environment() == 'production')
			<script>
				(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
				})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

				ga('create', 'UA-36909106-4', 'auto');
				ga('send', 'pageview');
			</script>
		@endif
	</body>
</html>