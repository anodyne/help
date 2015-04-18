@extends('layouts.master')

@section('title')
	{{ $product->present()->name }} Articles
@stop

@section('content')
	<h1>{{ $product->present()->name }} Articles <small>{{ $articles->count().' '.Str::plural('Article', $articles->count()) }}</small></h1>

	@if ($articles->count() > 0)
		@if ($featured->count() > 0)
			<div class="row">
			@foreach ($featured as $feature)
				<div class="col-md-6">
					<div class="well">
						<h3 class="text-center">{!! $feature->present()->title !!}</h3>
						<p class="text-center">
							{!! $feature->present()->productAsLabel !!}
							{!! $feature->present()->tagsAsLabel !!}
						</p>
						<span class="text-sm text-muted">{!! $feature->present()->summary !!}</span>
						<a href="{{ route('article.show', [$feature->product->slug, $feature->slug]) }}" class="btn btn-primary btn-lg btn-block">View Article</a>
					</div>
				</div>
			@endforeach
			</div>
		@endif

		<dl>
			@foreach ($articles as $article)
				{!! partial('article', ['article' => $article, 'rating' => false]) !!}
			@endforeach
		</dl>
	@else
		{!! alert('warning', "No articles found") !!}
	@endif
@stop