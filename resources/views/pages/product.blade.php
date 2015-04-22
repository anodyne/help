@extends('layouts.master')

@section('title')
	{{ $product->present()->name }} Articles
@stop

@section('content')
	<h1>{{ $product->present()->name }}</h1>

	{!! $product->present()->description !!}

	@if ($product->description)
		<hr class="partial-split">
	@endif

	{!! Form::open(['route' => 'search.doAdvanced', 'method' => 'get']) !!}
		{!! Form::hidden('p[]', $product->id) !!}

		<div class="form-group">
			<div class="row">
				<div class="col-sm-9 col-md-8 col-md-offset-1 col-lg-6 col-lg-offset-2">
					<p>{!! Form::text('q', null, ['class' => 'form-control input-lg', 'placeholder' => "Search ".$product->name." Articles..."]) !!}</p>
				</div>
				<div class="col-sm-3 col-md-2 col-lg-2">
					<p>{!! Form::button("Search", ['type' => 'submit', 'class' => 'btn btn-primary btn-lg btn-block']) !!}</p>
				</div>
			</div>
		</div>
	{!! Form::close() !!}

	<hr class="partial-split">

	<div class="row">
		<div class="col-md-4">
			<h2><span class="icn-size-md">{!! $_icons['star'] !!}</span> Featured</h2>

			@if ($featured->count() > 0)
				<dl>
					@foreach ($featured as $article)
						{!! partial('article', ['article' => $article, 'rating' => false]) !!}
					@endforeach
				</dl>
			@else
				{!! alert('warning', "No featured articles found") !!}
			@endif
		</div>

		<div class="col-md-4">
			<h2><span class="icn-size-md">{!! $_icons['thumbsUp'] !!}</span> Most Helpful</h2>

			@if ($helpful->count() > 0)
				<dl>
					@foreach ($helpful as $article)
						{!! partial('article', ['article' => $article, 'rating' => true]) !!}
					@endforeach
				</dl>
			@else
				{!! alert('warning', "Not enough rated articles found") !!}
			@endif
		</div>

		<div class="col-md-4">
			<h2><span class="icn-size-md">{!! $_icons['new'] !!}</span> Newest</h2>

			@if ($newest->count() > 0)
				<dl>
					@foreach ($newest as $article)
						{!! partial('article', ['article' => $article, 'rating' => false]) !!}
					@endforeach
				</dl>
			@else
				{!! alert('warning', "No articles found") !!}
			@endif
		</div>
	</div>
@stop