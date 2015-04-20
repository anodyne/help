@extends('layouts.master')

@section('title')
	Home
@stop

@section('content')
	<h1>How Can We Help?</h1>

	<div class="row">
		<div class="col-sm-6 col-lg-3">
			<div class="well">
				<div class="icn-size-xlg text-center">{!! $_icons['flag'] !!}</div>
				<a href="#" class="btn btn-primary btn-lg btn-block js-toggle" data-type="product">Help by Product</a>
			</div>
		</div>
		<div class="col-sm-6 col-lg-3">
			<div class="well">
				<div class="icn-size-xlg text-center">{!! $_icons['tag'] !!}</div>
				<a href="#" class="btn btn-primary btn-lg btn-block js-toggle" data-type="topic">Help by Topic</a>
			</div>
		</div>
		<div class="col-sm-6 col-lg-3">
			<div class="well">
				<div class="icn-size-xlg text-center">{!! $_icons['new'] !!}</div>
				<a href="#" class="btn btn-primary btn-lg btn-block js-toggle" data-type="latest">Latest Articles</a>
			</div>
		</div>
		<div class="col-sm-6 col-lg-3">
			<div class="well">
				<div class="icn-size-xlg text-center">{!! $_icons['thumbsUp'] !!}</div>
				<a href="#" class="btn btn-primary btn-lg btn-block js-toggle" data-type="helpful">Helpful Articles</a>
			</div>
		</div>
	</div>

	<div id="containerProducts" class="hide">
		<h2 class="hidden-header-product">Get Help by Product</h2>

		<div class="row">
		@foreach ($products as $product)
			<div class="col-md-6 col-lg-4">
				<p><a href="{{ route('product', [$product->slug]) }}" class="btn btn-default btn-lg btn-block">{!! $product->present()->name !!}</a></p>
			</div>
		@endforeach
		</div>
	</div>

	<div id="containerTopics" class="hide">
		<h2 class="hidden-header-topic">Get Help by Topic</h2>

		<div class="row">
		@foreach ($tags as $tag)
			<div class="col-md-6 col-lg-4">
				<p><a href="{{ route('tag', [$tag->slug]) }}" class="btn btn-default btn-lg btn-block">{!! $tag->present()->name !!}</a></p>
			</div>
		@endforeach
		</div>
	</div>

	<div id="containerLatest" class="hide">
		<h2 class="hidden-header-latest">Latest Articles</h2>

		<div class="row">
		@foreach ($newest as $new)
			<div class="col-md-4">
				<p><a href="{{ route('article.show', [$new->product->slug, $new->slug]) }}" class="btn btn-link btn-lg btn-block">{!! $new->present()->title !!}</a></p>
			</div>
		@endforeach
		</div>
	</div>

	<div id="containerHelpful" class="hide">
		<h2 class="hidden-header-helpful">Most Helpful Articles</h2>

		@if ($helpful->count() > 0)
			<div class="row">
			@foreach ($helpful as $help)
				<div class="col-md-6">
					<p><a href="{{ route('article.show', [$help->product->slug, $help->slug]) }}" class="btn btn-link btn-lg btn-block">{!! $help->present()->title !!}</a></p>
				</div>
			@endforeach
			</div>
		@else
			{!! alert('warning', "Not enough rated articles") !!}
		@endif
	</div>
@stop

@section('scripts')
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/2.1.0/jquery.scrollTo.min.js"></script>
	<script>
		$('.js-toggle').on('click', function(e)
		{
			e.preventDefault();

			// Grab the type
			var type = $(this).data('type');

			// Reset
			$('#containerHelpful').addClass('hide');
			$('#containerLatest').addClass('hide');
			$('#containerTopics').addClass('hide');
			$('#containerProducts').addClass('hide');

			if (type == "product")
				$('#containerProducts').removeClass('hide');

			if (type == "topic")
				$('#containerTopics').removeClass('hide');

			if (type == "latest")
				$('#containerLatest').removeClass('hide');

			if (type == "helpful")
				$('#containerHelpful').removeClass('hide');

			$(window).scrollTo(".hidden-header-" + type, 500);
		});
	</script>
@stop