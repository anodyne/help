@extends('layouts.master')

@section('title')
	Edit an Article
@stop

@section('content')
	<h1>Edit an Article</h1>

	<div class="visible-xs visible-sm">
		<p><a href="{{ route('admin.article.index') }}" class="btn btn-default btn-lg btn-block">Back to Articles</a></p>
	</div>
	<div class="visible-md visible-lg">
		<div class="btn-toolbar">
			<div class="btn-group">
				<a href="{{ route('admin.article.index') }}" class="btn btn-default">Back to Articles</a>
			</div>
		</div>
	</div>

	{!! Form::model($article, ['route' => ['admin.article.update', $article->id], 'method' => 'put', 'class' => 'form-horizontal']) !!}
		<div class="form-group{{ ($errors->has('product_id')) ? ' has-error' : '' }}">
			<label class="control-label col-md-2">Product</label>
			<div class="col-md-9">
				<div class="row">
				@foreach ($products as $id => $product)
					<div class="col-sm-6 col-md-4">
						<div class="radio">
							<label>{!! Form::radio('product_id', $id) !!} {{ $product }}</label>
						</div>
					</div>
				@endforeach
				</div>
				{!! $errors->first('product_id', '<p class="help-block">:message</p>') !!}
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-md-2">Tag(s)</label>
			<div class="col-md-9">
				<div class="row">
				@foreach ($tags as $id => $tag)
					<?php $checked = (bool) in_array($id, $articleTags);?>
					<div class="col-sm-6 col-md-4">
						<div class="checkbox">
							<label>{!! Form::checkbox('tag[]', $id, $checked) !!} {{ $tag }}</label>
						</div>
					</div>
				@endforeach
				</div>
			</div>
		</div>

		<div class="form-group{{ ($errors->has('title')) ? ' has-error' : '' }}">
			<label class="control-label col-md-2">Title</label>
			<div class="col-md-6">
				{!! Form::text('title', null, ['class' => 'form-control input-lg']) !!}
				{!! $errors->first('title', '<p class="help-block">:message</p>') !!}
			</div>
		</div>

		<div class="form-group{{ ($errors->has('slug')) ? ' has-error' : '' }}">
			<label class="control-label col-md-2">Slug</label>
			<div class="col-md-6">
				{!! Form::text('slug', null, ['class' => 'form-control input-lg']) !!}
				{!! $errors->first('title', '<p class="help-block">:message</p>') !!}
			</div>
		</div>

		<div class="form-group{{ ($errors->has('summary')) ? ' has-error' : '' }}">
			<label class="control-label col-md-2">Summary</label>
			<div class="col-md-6">
				{!! Form::textarea('summary', null, ['class' => 'form-control input-lg', 'rows' => 3]) !!}
				{!! $errors->first('summary', '<p class="help-block">:message</p>') !!}
			</div>
		</div>

		<div class="form-group{{ ($errors->has('content')) ? ' has-error' : '' }}">
			<label class="control-label col-md-2">Content</label>
			<div class="col-md-10">
				{!! Form::textarea('content', null, ['class' => 'form-control input-lg']) !!}
				{!! $errors->first('content', '<p class="help-block">:message</p>') !!}
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-md-2">Featured</label>
			<div class="col-md-8">
				<div class="radio">
					<label>{!! Form::radio('featured', (int) true) !!} Yes</label>
				</div>
				<div class="radio">
					<label>{!! Form::radio('featured', (int) false) !!} No</label>
				</div>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-md-2">Published</label>
			<div class="col-md-8">
				<div class="radio">
					<label>{!! Form::radio('published', (int) true) !!} Yes</label>
				</div>
				<div class="radio">
					<label>{!! Form::radio('published', (int) false) !!} No</label>
				</div>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-md-2">Keywords</label>
			<div class="col-md-8">
				{!! Form::textarea('keywords', null, ['class' => 'form-control input-lg', 'rows' => 2]) !!}
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-5 col-md-offset-2">
				<div class="visible-xs visible-sm">
					{!! Form::button("Update Article", ['type' => 'submit', 'class' => 'btn btn-primary btn-lg btn-block']) !!}
				</div>
				<div class="visible-md visible-lg">
					{!! Form::button("Update Article", ['type' => 'submit', 'class' => 'btn btn-primary btn-lg']) !!}
				</div>
			</div>
		</div>
	{!! Form::close() !!}
@stop

@section('styles')
	{!! HTML::style('codemirror/codemirror.css') !!}
	{!! HTML::style('uikit/css/uikit.min.css') !!}
	{!! HTML::style('uikit/css/components/htmleditor.min.css') !!}
	{!! HTML::style('uikit/css/components/htmleditor.almost-flat.min.css') !!}
@stop

@section('scripts')
	{!! HTML::script('codemirror/codemirror.js') !!}
	{!! HTML::script('codemirror/mode/markdown/markdown.js') !!}
	{!! HTML::script('codemirror/addon/mode/overlay.js') !!}
	{!! HTML::script('codemirror/mode/xml/xml.js') !!}
	{!! HTML::script('codemirror/mode/gfm/gfm.js') !!}
	{!! HTML::script('js/marked.js') !!}
	{!! HTML::script('uikit/js/core/core.min.js') !!}
	{!! HTML::script('uikit/js/components/htmleditor.min.js') !!}
	<script>
		$('[name="slug"]').on('change', function(e)
		{
			var $field = $(this);

			if ($('[name="product_id"]:checked').length == 0)
			{
				alert("Please select a product");
			}
			else
			{
				$.ajax({
					url: "{{ url('admin/article/set-slug') }}",
					dataType: "json",
					type: "POST",
					data: {
						value: $field.val(),
						product: $('[name="product_id"]:checked').val()
					},
					success: function (data)
					{
						$field.val(data.slug);

						if (data.code == 0)
							alert("An article with this slug already exists. Please enter a unique slug.");
					}
				});
			}
		});

		$(function()
		{
			var editor = UIkit.htmleditor('[name="content"]', {
				mode: "tab",
				markdown: true
			});
		});
	</script>
@stop