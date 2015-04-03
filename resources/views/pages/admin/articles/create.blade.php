@extends('layouts.master')

@section('title')
	Add an Article
@stop

@section('content')
	<h1>Add an Article</h1>

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

	{!! Form::open(['route' => 'admin.article.store', 'class' => 'form-horizontal']) !!}
		<div class="form-group">
			<label class="control-label col-md-2">Product</label>
			<div class="col-md-9">
				<div class="row">
				@foreach ($products as $id => $product)
					<div class="col-sm-6 col-md-4">
						<div class="radio">
							<label>{!! Form::radio('product_id', $id, false) !!} {{ $product }}</label>
						</div>
					</div>
				@endforeach
				</div>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-md-2">Tag(s)</label>
			<div class="col-md-9">
				<div class="row">
				@foreach ($tags as $id => $tag)
					<div class="col-sm-6 col-md-4">
						<div class="checkbox">
							<label>{!! Form::checkbox('tags[]', $id, false) !!} {{ $tag }}</label>
						</div>
					</div>
				@endforeach
				</div>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-md-2">Title</label>
			<div class="col-md-6">
				{!! Form::text('title', null, ['class' => 'form-control input-lg']) !!}
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-md-2">Slug</label>
			<div class="col-md-6">
				{!! Form::text('slug', null, ['class' => 'form-control input-lg']) !!}
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-md-2">Summary</label>
			<div class="col-md-6">
				{!! Form::textarea('summary', null, ['class' => 'form-control input-lg', 'rows' => 3]) !!}
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-md-2">Content</label>
			<div class="col-md-10">
				{!! Form::textarea('content', null, ['class' => 'form-control input-lg']) !!}
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-5 col-md-offset-2">
				<div class="visible-xs visible-sm">
					{!! Form::button("Add Article", ['type' => 'submit', 'class' => 'btn btn-primary btn-lg btn-block']) !!}
				</div>
				<div class="visible-md visible-lg">
					{!! Form::button("Add Article", ['type' => 'submit', 'class' => 'btn btn-primary btn-lg']) !!}
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
		$(function()
		{
			var editor = UIkit.htmleditor('[name="content"]', {
				mode: "tab",
				markdown: true
			});
		});
	</script>
@stop