@extends('layouts.master')

@section('title')
	Article Review Queue
@stop

@section('content')
	<h1>Article Review Queue <small>{{ $reviews->count().' '.Str::plural('article', $reviews->count()) }}</small></h1>

	@if ($reviews->count() > 0)
		<div class="data-table data-table-bordered data-table-striped">
		@foreach ($reviews as $review)
			<div class="row">
				<div class="col-md-8 col-lg-9">
					<p class="lead">
						{!! $review->present()->typeAsLabel !!}
						{{ $review->present()->article }}
					</p>
					<div class="text-sm">{!! $review->present()->notes !!}</div>
				</div>
				<div class="col-md-4 col-lg-3">
					<div class="visible-xs visible-sm">
						<div class="row">
							<p><a href="{{ route('admin.review.show', [$review->id]) }}" class="btn btn-default btn-lg btn-block">View</a></p>
						</div>
					</div>
					<div class="visible-md visible-lg">
						<div class="btn-toolbar pull-right">
							<div class="btn-group">
								<a href="{{ route('admin.review.show', [$review->id]) }}" class="btn btn-default">View</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endforeach
		</div>
	@else
		{!! alert('warning', "No article reviews found.") !!}
	@endif
@stop