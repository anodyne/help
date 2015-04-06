@extends('layouts.master')

@section('title')
	Article Review Request
@stop

@section('content')
	<h1>Article Review Request</h1>

	<div class="visible-xs visible-sm">
		<p><a href="{{ route('admin.review.index') }}" class="btn btn-default btn-lg btn-block">Back to the Queue</a></p>
		<p><a href="#" class="btn btn-default btn-lg btn-block">View Article</a></p>
		<p><a href="{{ route('admin.article.edit', [$article->id]) }}" class="btn btn-default btn-lg btn-block">Edit Article</a></p>
	</div>
	<div class="visible-md visible-lg">
		<div class="btn-toolbar">
			<div class="btn-group">
				<a href="{{ route('admin.review.index') }}" class="btn btn-default">Back to the Queue</a>
			</div>
			<div class="btn-group">
				<a href="#" class="btn btn-default">View Article</a>
				<a href="{{ route('admin.article.edit', [$article->id]) }}" class="btn btn-default">Edit Article</a>
			</div>
		</div>
	</div>

	<form class="form-horizontal">
		<div class="form-group">
			<label class="control-label col-md-2">Article</label>
			<div class="col-md-5">
				<p class="form-control-static">{{ $article->present()->title }}</p>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-md-2">Submitter</label>
			<div class="col-md-5">
				<p class="form-control-static">{{ $review->present()->submitter }}</p>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-md-2">Review Type</label>
			<div class="col-md-5">
				<p class="form-control-static">{{ $review->present()->type(true) }}</p>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-md-2">Notes</label>
			<div class="col-md-5">
				<div class="form-control-static">{!! $review->present()->notes !!}</div>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-2 col-md-offset-2">
				<div class="visible-xs visible-sm">
					<p><a href="#" class="btn btn-primary btn-lg btn-block js-reviewAction" data-id="{{ $review->id }}">Update</a></p>
				</div>
				<div class="visible-md visible-lg">
					<p><a href="#" class="btn btn-primary btn-lg js-reviewAction" data-id="{{ $review->id }}">Update</a></p>
				</div>
			</div>
		</div>
	</form>
@stop

@section('modals')
	{!! modal(['id' => 'updateReview', 'header' => "Update Review Request"]) !!}
@stop

@section('scripts')
	<script>
		$('.js-reviewAction').on('click', function(e)
		{
			e.preventDefault();

			var id = $(this).data('id');

			$('#updateReview').modal({
				remote: "{{ url('admin/review') }}/" + id + "/edit"
			}).modal('show');
		});
	</script>
@stop