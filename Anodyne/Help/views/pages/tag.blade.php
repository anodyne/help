@extends('layouts.master')

@section('title')
	{{ $tag->present()->name }}
@stop

@section('content')
	<h1>{{ $tag->present()->name }} <small>{{ $count }} Articles</small></h1>

	<dl>
	@forelse ($articles as $article)
		{{ partial('article', ['article' => $article, 'rating' => true]) }}
	@empty
		{{ alert('warning', "No articles found.") }}
	@endforelse
	</dl>
@stop