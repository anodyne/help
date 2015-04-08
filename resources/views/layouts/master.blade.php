<!DOCTYPE html>
<html lang="en" ng-app="app">
	<head>
		<meta charset="utf-8">
		<title>@yield('title') &bull; Anodyne Help Center</title>
		<meta name="description" content="Anodyne Productions specializes in RPG management software and tools to help game masters play and run their games with powerful and easy-to-use software.">
		<meta name="author" content="Anodyne Productions">
		<meta name="viewport" content="width=device-width">
		<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico?v1') }}">
		<link rel="apple-touch-icon-precomposed" href="{{ asset('apple-touch-icon.png') }}">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<!--[if lt IE 9]>
			{!! HTML::script('js/html5shiv.js') !!}
		<![endif]-->
		
		{!! partial('global_styles') !!}
		{!! HTML::style('css/style.css') !!}
		{!! HTML::style('css/fonts.css') !!}
		{!! HTML::style('css/responsive.css') !!}
		@yield('styles')
	</head>
	<body>
		<div class="wrapper">
			{!! View::make('partials.nav-main') !!}

			<header>
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-md-5">
							<a href="{{ route('home') }}" class="brand">Anodyne Help Center</a>
						</div>

						<div class="col-xs-12 col-md-7">
							<nav class="nav-sub">
								<ul>
									<li><a href="{{ route('product', ['nova-2']) }}">Nova 2</a></li>
									<li><a href="{{ route('product', ['nova-3']) }}">Nova 3</a></li>
									<li><a href="{{ route('product', ['xtras']) }}">AnodyneXtras</a></li>
									<li><a href="{{ route('search.advanced') }}">Advanced Search</a></li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</header>

			<div class="search-help">
				<div class="container">
					{!! Form::open(['route' => 'search.do', 'method' => 'get']) !!}
					<div class="row">
						<div class="col-xs-12">
							<div class="input-group">
								<span class="input-group-addon">{!! $_icons['search-lg'] !!}</span>
								{!! Form::text('q', null, ['placeholder' => 'Search the Help Center', 'class' => 'input-lg form-control search-field']) !!}
							</div>
						</div>
					</div>
					{!! Form::close() !!}
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

			<footer>
				<div class="container">
					<div class="row">
						<div class="col-sm-9 col-md-10">
							<h2>Anodyne Help Center</h2>

							<p>Our mission is simple: provide products of the highest quality. That's been the driving force behind our efforts since the day we opened our doors; we don't just want to meet your expectations for powerful and easy-to-use web software, we want to exceed it.</p>

							<p>&copy; {{ Date::now()->year }} Anodyne Productions</p>
						</div>
						<div class="col-sm-3 col-md-2">
							<ul class="list-unstyled">
								<li><a href="{{ config('anodyne.links.www') }}">Home</a></li>
								<li><a href="{{ config('anodyne.links.nova') }}">Nova</a></li>
								<li><a href="{{ config('anodyne.links.xtras') }}">AnodyneXtras</a></li>
								<li><a href="{{ config('anodyne.links.forums') }}">Forums</a></li>
								<li><a href="#" class="js-contact">Contact</a></li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>

		<div id="contactModal" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content"></div>
			</div>
		</div>

		@yield('modals')
		
		{!! partial('global_scripts') !!}
		<script>
			$.ajaxPrefilter(function(options, originalOptions, xhr)
			{
				var token = $('meta[name="csrf-token"]').attr('content');

				if (token)
					return xhr.setRequestHeader('X-CSRF-TOKEN', token);
			});

			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			
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
		</script>
		@yield('scripts')
		@if (app('env') == 'production')
			<script>
				(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
				})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

				ga('create', 'UA-36909106-1', 'auto');
				ga('send', 'pageview');
			</script>
		@endif
	</body>
</html>