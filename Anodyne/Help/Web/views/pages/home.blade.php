@extends('layouts.master')

@section('title')
	Home
@stop

@section('content')
	<div class="row">
		<div class="col-xs-12 col-md-10 col-lg-8 col-md-offset-1 col-lg-offset-2">
			<div class="row">
				<div class="col-xs-12 col-md-9">
					<div class="form-group">
						{{ Form::text('search', null, ['placeholder' => 'Search the Help Center', 'class' => 'input-lg form-control search-field']) }}
					</div>
				</div>
				<div class="col-xs-12 col-md-3">
					{{ Form::button('Search', array('class' => 'btn btn-block btn-default btn-lg', 'type' => 'submit')) }}
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-md-10 col-lg-8 col-md-offset-1 col-lg-offset-2">
			<hr>
		</div>
	</div>

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
