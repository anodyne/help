@extends('layouts.master')

@section('title')
	{{ $article->present()->title }} - View Article
@stop

@section('content')
	<h1>{{ $article->present()->title }}</h1>

	<p>
		{!! $article->present()->productAsLabel !!}
		{!! $article->present()->tagsAsLabel !!}
	</p>

	<div class="row">
		<div class="col-md-8 col-lg-9">
			{!! $article->present()->content !!}
		</div>

		<div class="col-md-4 col-lg-3">
			@if ($_currentUser)
				<div class="">
					@if ($_currentUser->can('help.admin'))
						<p class="visible-xs visible-sm"><a href="{{ route('admin.article.edit', [$article->id]) }}" class="btn btn-default btn-lg btn-block">Edit Article</a></p>
						<p class="visible-md visible-lg"><a href="{{ route('admin.article.edit', [$article->id]) }}" class="btn btn-default btn-block">Edit Article</a></p>
					@endif
					
					<p class="visible-xs visible-sm"><a href="#" class="btn btn-default btn-lg btn-block">Share</a></p>
					<p class="visible-md visible-lg"><a href="#" class="btn btn-default btn-block">Share</a></p>

					<p class="visible-xs visible-sm"><a href="#" class="btn btn-warning btn-lg btn-block">Article Needs Review</a></p>
					<p class="visible-md visible-lg"><a href="#" class="btn btn-warning btn-block">Article Needs Review</a></p>

					<hr class="partial-split">

					<div class="row">
						<div class="col-xs-6">
							<p class="visible-xs visible-sm"><a href="#" class="btn btn-success btn-lg btn-block js-rate" data-article="{{ $article->id }}" data-rating="1">{!! $_icons['thumbsUp'] !!}</a></p>
							<p class="visible-md visible-lg"><a href="#" class="btn btn-success btn-block js-rate" data-article="{{ $article->id }}" data-rating="1">{!! $_icons['thumbsUp'] !!}</a></p>
						</div>
						<div class="col-xs-6">
							<p class="visible-xs visible-sm"><a href="#" class="btn btn-danger btn-lg btn-block js-rate" data-article="{{ $article->id }}" data-rating="0">{!! $_icons['thumbsDown'] !!}</a></p>
							<p class="visible-md visible-lg"><a href="#" class="btn btn-danger btn-block js-rate" data-article="{{ $article->id }}" data-rating="0">{!! $_icons['thumbsDown'] !!}</a></p>
						</div>
					</div>

					@if ($rating > 0)
						<p class="text-sm text-muted text-center">{{ $rating }} {{ Str::plural('person', $rating) }} found this article helpful</p>
					@endif
				</div>
			@else
				{!! alert('info', "Log in with your AnodyneID to rate this article or submit the article for review.") !!}
			@endif
		</div>
	</div>
@stop

@section('modals')
@stop

@section('scripts')
	<script>
		$('.js-rate').on('click', function(e)
		{
			e.preventDefault();

			$.ajax({
				url: "{{ route('article.rate') }}",
				type: "POST",
				dataType: "json",
				data: {
					article: $(this).data('article'),
					rating: $(this).data('rating')
				},
				success: function (data)
				{
					//
				}
			});
		});
	</script>
@stop