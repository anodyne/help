@extends('layouts.master')

@section('title')
	{{ $tag->present()->name }} Articles
@stop

@section('content')
	<h1>{{ $tag->present()->name }} Articles</h1>

	@if ($articles->count() > 0)
		<hr class="partial-split">

		{!! Form::open(['route' => 'search.doAdvanced', 'method' => 'get']) !!}
			{!! Form::hidden('t[]', $tag->id) !!}

			<div class="form-group">
				<div class="row">
					<div class="col-sm-9 col-md-8 col-md-offset-1 col-lg-6 col-lg-offset-2">
						<p>{!! Form::text('q', null, ['class' => 'form-control input-lg', 'placeholder' => "Search ".$tag->name." Articles..."]) !!}</p>
					</div>
					<div class="col-sm-3 col-md-2 col-lg-2">
						<p>{!! Form::button("Search", ['type' => 'submit', 'class' => 'btn btn-primary btn-lg btn-block']) !!}</p>
					</div>
				</div>
			</div>
		{!! Form::close() !!}

		<hr class="partial-split">

		<div class="row">
		@foreach ($articles as $article)
			<div class="col-md-6">
				{!! partial('article-block', ['article' => $article, 'rating' => false]) !!}
			</div>
		@endforeach
		</div>
	@else
		{!! alert('warning', "No articles found") !!}
	@endif
@stop