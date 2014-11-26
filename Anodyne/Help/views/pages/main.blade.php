@extends('layouts.master')

@section('title')
	Home
@stop

@section('content')
	<div class="row">
		<div class="col-md-6">
			<h2>Latest Articles</h2>

			<dl>
				@foreach ($latest as $article)
					{{ partial('article', ['article' => $article, 'rating' => false]) }}
				@endforeach
			</dl>
		</div>

		<div class="col-md-6">
			<h2>Most Helpful Articles</h2>

			<dl>
				@foreach ($helpful as $article)
					{{ partial('article', ['article' => $article, 'rating' => true]) }}
				@endforeach
			</dl>
		</div>
	</div>
@stop
