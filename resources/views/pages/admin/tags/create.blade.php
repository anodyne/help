@extends('layouts.master')

@section('title')
	Add a Tag
@stop

@section('content')
	<h1>Add a Tag</h1>

	<div class="visible-xs visible-sm">
		<p><a href="{{ route('admin.tag.index') }}" class="btn btn-default btn-lg btn-block">Back to Tags</a></p>
	</div>
	<div class="visible-md visible-lg">
		<div class="btn-toolbar">
			<div class="btn-group">
				<a href="{{ route('admin.tag.index') }}" class="btn btn-default">Back to Tags</a>
			</div>
		</div>
	</div>

	{!! Form::open(['route' => 'admin.tag.store', 'class' => 'form-horizontal']) !!}
		<div class="form-group{{ ($errors->has('name')) ? ' has-error' : '' }}">
			<label class="control-label col-md-2">Name</label>
			<div class="col-md-5">
				{!! Form::text('name', null, ['class' => 'form-control input-lg']) !!}
				{!! $errors->first('name', '<p class="help-block">:message</p>') !!}
			</div>
		</div>

		<div class="form-group{{ ($errors->has('slug')) ? ' has-error' : '' }}">
			<label class="control-label col-md-2">Slug</label>
			<div class="col-md-5">
				{!! Form::text('slug', null, ['class' => 'form-control input-lg']) !!}
				{!! $errors->first('slug', '<p class="help-block">:message</p>') !!}
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-md-2">Display?</label>
			<div class="col-md-5">
				<div class="radio-inline">
					<label>{!! Form::radio('display', (int) true, true) !!} Yes</label>
				</div>
				<div class="radio-inline">
					<label>{!! Form::radio('display', (int) false, false) !!} No</label>
				</div>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-5 col-md-offset-2">
				<div class="visible-xs visible-sm">
					{!! Form::button("Add Tag", ['type' => 'submit', 'class' => 'btn btn-primary btn-lg btn-block']) !!}
				</div>
				<div class="visible-md visible-lg">
					{!! Form::button("Add Tag", ['type' => 'submit', 'class' => 'btn btn-primary btn-lg']) !!}
				</div>
			</div>
		</div>
	{!! Form::close() !!}
@stop

@section('scripts')
	<script>
		$('[name="name"]').on('change', function(e)
		{
			$.ajax({
				url: "{{ url('admin/tag/set-slug') }}",
				dataType: "json",
				type: "POST",
				data: {
					value: $(this).val()
				},
				success: function (data)
				{
					$('[name="slug"]').val(data.slug);
				}
			});
		});
	</script>
@stop