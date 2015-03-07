@extends('layouts.master')

@section('title')
	Search Results
@stop

@section('content')
	<h1>Search Results <small>"{{ $term }}"</small></h1>

	<div class="row">
		<div class="col-md-5 col-lg-5">
			{{ Form::open(['route' => 'search.do']) }}
				<div class="form-group">
					<div class="input-group">
						{{ Form::text('search', null, array('placeholder' => 'Search the Help Center', 'class' => 'form-control')) }}
						<span class="input-group-btn">{{ Form::button('Search', array('class' => 'btn btn-default', 'type' => 'submit')) }}</span>
					</div>
				</div>
			{{ Form::close() }}
		</div>
		<div class="col-md-3 col-lg-3">
			<a href="{{ URL::route('search.advanced') }}" class="btn btn-link">Advanced Search</a>
		</div>
	</div>

	@if ($results->count() > 0)
		<div class="data-table data-table-bordered data-table-striped">
		@foreach ($results as $item)
			<div class="row">
				<div class="col-md-9 col-lg-9">
					<dl>
						{{ partial('article', ['article' => $item, 'rating' => true]) }}
					</dl>
				</div>
				<div class="col-md-3 col-lg-3">
					<div class="btn-toolbar pull-right">
						<div class="btn-group">
							<a href="{{ route('article.show', [$item->product->slug, $item->slug]) }}" class="btn btn-default">{{ $_icons['next'] }}</a>
						</div>
					</div>
				</div>
			</div>
		@endforeach
		</div>
	@else
		<p class="alert alert-warning">No articles found with the term {{ $term }}. Please try another search term.</p>
	@endif
@stop