@extends('layouts.master')

@section('title')
	Report: Least Helpful Articles
@stop

@section('content')
	<h1>Least Helpful Articles</h1>

	@if ($articles->count() > 0)
		<div class="data-table data-table-bordered data-table-striped">
		@foreach ($articles as $article)
			<div class="row">
				<div class="col-md-10">
					<p class="lead">{!! $article->present()->title !!}</p>
					<p>
						{!! label('danger', $article->getLeastHelpfulRatings()->count()) !!}
						{!! $article->present()->productAsLabel !!}
						{!! $article->present()->tagsAsLabel !!}
					</p>

					@if ($article->reviews->count() > 0)
						@foreach ($article->reviews as $review)
							<div class="row">
								<div class="col-xs-3 col-md-2">
									<p>{!! $review->present()->typeAsLabel !!}</p>
								</div>
								<div class="col-xs-9 col-md-8">{!! $review->present()->comments !!}</div>
								<div class="col-xs-12 col-md-2">
									<p class="visible-xs visible-sm"><a href="{{ route('admin.review.show', [$review->id]) }}" class="btn btn-default btn-lg btn-block">Review</a></p>
									<p class="visible-md visible-lg"><a href="{{ route('admin.review.show', [$review->id]) }}" class="btn btn-default btn-block">Review</a></p>
								</div>
							</div>
						@endforeach
					@endif
				</div>
				<div class="col-md-2">
					<div class="visible-xs visible-sm">
						<p><a href="{{ route('article.show', [$article->product->slug, $article->slug]) }}" class="btn btn-default btn-lg btn-block">View Article</a></p>
						<p><a href="{{ route('admin.article.edit', [$article->id]) }}" class="btn btn-default btn-lg btn-block">Edit Article</a></p>
					</div>
					<div class="visible-md visible-lg">
						<div class="btn-toolbar pull-right">
							<div class="btn-group">
								<a href="{{ route('article.show', [$article->product->slug, $article->slug]) }}" class="btn btn-default">View</a>
							</div>
							<div class="btn-group">
								<a href="{{ route('admin.article.edit', [$article->id]) }}" class="btn btn-default">Edit</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endforeach
		</div>
	@else
		{!! alert('success', "No articles have been marked as not helpful!") !!}
	@endif
@stop