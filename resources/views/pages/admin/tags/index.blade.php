@extends('layouts.master')

@section('title')
	Tags
@stop

@section('content')
	<h1>Tags</h1>

	<div class="visible-xs visible-sm">
		<p><a href="{{ route('admin.tag.create') }}" class="btn btn-primary btn-lg btn-block">Add a Tag</a></p>
	</div>
	<div class="visible-md visible-lg">
		<div class="btn-toolbar">
			<div class="btn-group">
				<a href="{{ route('admin.tag.create') }}" class="btn btn-primary">Add a Tag</a>
			</div>
		</div>
	</div>

	@if ($tags->count() > 0)
		<div class="data-table data-table-bordered data-table-striped">
		@foreach ($tags as $tag)
			<div class="row">
				<div class="col-md-9">
					<p class="lead{{ ((bool) $tag->display === false) ? ' text-muted' : '' }}">{{ $tag->present()->name }}</p>
				</div>
				<div class="col-md-3">
					<div class="visible-xs visible-sm">
						<p><a href="{{ route('admin.tag.edit', [$tag->id]) }}" class="btn btn-default btn-lg btn-block">Edit</a></p>

						@if ($tag->trashed())
							<p><a href="#" class="btn btn-success btn-lg btn-block js-tagAction" data-id="{{ $tag->id }}" data-action="restore">Restore</a></p>
						@else
							<p><a href="#" class="btn btn-danger btn-lg btn-block js-tagAction" data-id="{{ $tag->id }}" data-action="remove">Remove</a></p>
						@endif
					</div>
					<div class="visible-md visible-lg">
						<div class="btn-toolbar pull-right">
							<div class="btn-group">
								<a href="{{ route('admin.tag.edit', [$tag->id]) }}" class="btn btn-default">Edit</a>
							</div>

							@if ($tag->trashed())
								<div class="btn-group">
									<a href="#" class="btn btn-success js-tagAction" data-id="{{ $tag->id }}" data-action="restore">Restore</a>
								</div>
							@else
								<div class="btn-group">
									<a href="#" class="btn btn-danger js-tagAction" data-id="{{ $tag->id }}" data-action="remove">Remove</a>
								</div>
							@endif
						</div>
					</div>
				</div>
			</div>
		@endforeach
		</div>
	@else
		{!! alert('warning', "No tags found") !!}
	@endif
@stop

@section('modals')
	{!! modal(['id' => 'removeTag', 'header' => "Remove Tag"]) !!}
	{!! modal(['id' => 'restoreTag', 'header' => "Restore Tag"]) !!}
@stop

@section('scripts')
	<script>
		$('.js-tagAction').on('click', function(e)
		{
			e.preventDefault();

			var id = $(this).data('id');
			var action = $(this).data('action');

			if (action == 'remove')
			{
				$('#removeTag').modal({
					remote: "{{ url('admin/tag') }}/" + id + "/remove"
				}).modal('show');
			}

			if (action == 'restore')
			{
				$('#restoreTag').modal({
					remote: "{{ url('admin/tag') }}/" + id + "/restore"
				}).modal('show');
			}
		});
	</script>
@stop