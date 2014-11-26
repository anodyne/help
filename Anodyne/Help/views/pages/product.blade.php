@extends('layouts.master')

@section('title')
	{{ $product->present()->name }}
@stop

@section('content')
	<h1>{{ $product->present()->name }} <small>{{ $count }} Articles</small></h1>

	<dl>
	@forelse ($articles as $article)
		{{ partial('article', ['article' => $article, 'rating' => true]) }}
	@empty
		{{ alert('warning', "No articles found.") }}
	@endforelse
	</dl>
@stop