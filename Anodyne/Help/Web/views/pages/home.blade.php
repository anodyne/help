@extends('layouts.master')

@section('title')
	Home
@stop

@section('content')
	<div class="row">
		<div class="col-xs-12 col-md-8 col-lg-6 col-md-offset-2 col-lg-offset-3">
			<div class="form-group">
				<div class="input-group">
					{{ Form::text('search', null, array('placeholder' => 'Search the Help Center', 'class' => 'input-lg form-control search-field')) }}
					<span class="input-group-btn">{{ Form::button('Search', array('class' => 'btn btn-default btn-lg', 'type' => 'submit')) }}</span>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-md-10 col-lg-8 col-md-offset-1 col-lg-offset-2">
			<hr>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<h2>Latest Articles</h2>

			<dl>
				<dt><a href="#">Article Title</a></dt>
				<dd>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua.</dd>
				<dd>
					<span class="label label-default">Product</span>
					<span class="label label-success">Tag #1</span>
					<span class="label label-success">Tag #2</span>
					<span class="label label-success">Tag #3</span>
				</dd>

				<dt><a href="#">Article Title</a></dt>
				<dd>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua.</dd>
				<dd>
					<span class="label label-default">Product</span>
					<span class="label label-success">Tag #1</span>
					<span class="label label-success">Tag #2</span>
					<span class="label label-success">Tag #3</span>
				</dd>

				<dt><a href="#">Article Title</a></dt>
				<dd>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua.</dd>
				<dd>
					<span class="label label-default">Product</span>
					<span class="label label-success">Tag #1</span>
					<span class="label label-success">Tag #2</span>
					<span class="label label-success">Tag #3</span>
				</dd>
			</dl>
		</div>

		<div class="col-md-6">
			<h2>Most Helpful Articles</h2>

			<dl>
				<dt><a href="#">Article Title</a></dt>
				<dd>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua.</dd>
				<dd>
					<span class="label label-default">Product</span>
					<span class="label label-success">Tag #1</span>
					<span class="label label-success">Tag #2</span>
					<span class="label label-success">Tag #3</span>
				</dd>

				<dt><a href="#">Article Title</a></dt>
				<dd>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua.</dd>
				<dd>
					<span class="label label-default">Product</span>
					<span class="label label-success">Tag #1</span>
					<span class="label label-success">Tag #2</span>
					<span class="label label-success">Tag #3</span>
				</dd>

				<dt><a href="#">Article Title</a></dt>
				<dd>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua.</dd>
				<dd>
					<span class="label label-default">Product</span>
					<span class="label label-success">Tag #1</span>
					<span class="label label-success">Tag #2</span>
					<span class="label label-success">Tag #3</span>
				</dd>
			</dl>
		</div>
	</div>
@stop