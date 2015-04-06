@extends('layouts.master')

@section('title')
	Search Results
@stop

@section('content')
	<h1>Search Results <small>"{{ $term }}", {{ $results->total().' '.Str::plural('result', $results->total()) }}</small></h1>

	{!! Form::open(['route' => 'search.do', 'method' => 'get']) !!}
		<div class="row">
			<div class="col-md-5">
				<div class="form-group">
					{!! Form::text('q', null, ['placeholder' => 'Search the Help Center', 'class' => 'form-control input-lg']) !!}
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					{!! Form::button('Search', ['class' => 'btn btn-lg btn-block btn-primary', 'type' => 'submit']) !!}
				</div>
			</div>
			<div class="col-md-3">
				<a href="{{ route('search.advanced') }}" class="btn btn-lg btn-link">Advanced Search</a>
			</div>
		</div>
	{!! Form::close() !!}

	@if ($results->total() > 0)
		{!! $results->appends(Input::except(['page']))->render() !!}

		<div class="data-table data-table-bordered data-table-striped">
		@foreach ($results as $article)
			<div class="row">
				<div class="col-md-9">
					<p class="lead">{{ $article->present()->title }}</p>
					<p>
						{!! $article->present()->productAsLabel !!}
						{!! $article->present()->tagsAsLabel !!}
					</p>
					<p class="text-muted text-sm">{!! $article->present()->summary !!}</p>
				</div>
				<div class="col-md-3">
					<div class="btn-toolbar pull-right">
						@if (Auth::check() and $_currentUser->can('help.admin'))
							<div class="btn-group">
								<a href="{{ route('admin.article.edit', [$article->id]) }}" class="btn btn-default">Edit</a>
							</div>
						@endif

						<div class="btn-group">
							<a href="#" class="btn btn-default">View</a>
						</div>
					</div>
				</div>
			</div>
		@endforeach
		</div>

		{!! $results->appends(Input::except(['page']))->render() !!}
	@else
		{!! alert('warning', "No articles found with the term \"".$term."\". Please try another search term.") !!}
	@endif
@stop