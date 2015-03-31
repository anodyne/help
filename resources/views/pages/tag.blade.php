@extends('layouts.master')

@section('title')
	{{ $tag->present()->name }} Articles
@stop

@section('content')
	<h1>{{ $tag->present()->name }} Articles <small>{{ $articles->count().' '.Str::plural('Article', $articles->count()) }}</small></h1>

	@if ($articles->count() > 0)
		<dl>
			@foreach ($articles as $article)
				{!! partial('article', ['article' => $article, 'rating' => false]) !!}
			@endforeach
		</dl>
	@else
		{!! alert('warning', "No articles found") !!}
	@endif
@stop