@extends('layouts.master')

@section('title')
	Edit Product
@stop

@section('content')
	<h1>Edit Product <small>{{ $product->present()->name }}</small></h1>

	<div class="visible-xs visible-sm">
		<p><a href="{{ route('admin.product.index') }}" class="btn btn-default btn-lg btn-block">Back to Products</a></p>
	</div>
	<div class="visible-md visible-lg">
		<div class="btn-toolbar">
			<div class="btn-group">
				<a href="{{ route('admin.product.index') }}" class="btn btn-default">Back to Products</a>
			</div>
		</div>
	</div>

	{!! Form::model($product, ['route' => ['admin.product.update', $product->id], 'method' => 'put', 'class' => 'form-horizontal']) !!}
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
					<label>{!! Form::radio('display', (int) true, false) !!} Yes</label>
				</div>
				<div class="radio-inline">
					<label>{!! Form::radio('display', (int) false, false) !!} No</label>
				</div>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-md-2">Description</label>
			<div class="col-md-5">
				{!! Form::textarea('description', null, ['class' => 'form-control input-lg', 'rows' => 5]) !!}
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-5 col-md-offset-2">
				<div class="visible-xs visible-sm">
					{!! Form::button("Update Product", ['type' => 'submit', 'class' => 'btn btn-primary btn-lg btn-block']) !!}
				</div>
				<div class="visible-md visible-lg">
					{!! Form::button("Update Product", ['type' => 'submit', 'class' => 'btn btn-primary btn-lg']) !!}
				</div>
			</div>
		</div>
	{!! Form::close() !!}
@stop