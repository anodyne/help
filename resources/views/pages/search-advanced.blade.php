@extends('layouts.master')

@section('title')
	Advanced Search
@stop

@section('content')
	<h1>Advanced Search</h1>

	{!! Form::open(['route' => 'search.doAdvanced', 'method' => 'get', 'class' => 'form-horizontal']) !!}
		<div class="form-group">
			<label class="control-label col-md-2">Product</label>
			<div class="col-md-9">
				<div class="row">
				@foreach ($products as $id => $product)
					<div class="col-sm-6 col-md-4">
						<div class="checkbox">
							<label>{!! Form::checkbox('p[]', $id) !!} {{ $product }}</label>
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
							<label>{!! Form::checkbox('t[]', $id) !!} {{ $tag }}</label>
						</div>
					</div>
				@endforeach
				</div>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-md-2">Search Term</label>
			<div class="col-md-6">
				{!! Form::text('q', null, ['class' => 'form-control input-lg']) !!}
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-5 col-md-offset-2">
				<div class="visible-xs visible-sm">
					<p>{!! Form::button("Search", ['type' => 'submit', 'class' => 'btn btn-primary btn-lg btn-block']) !!}</p>
				</div>
				<div class="visible-md visible-lg">
					{!! Form::button("Search", ['type' => 'submit', 'class' => 'btn btn-primary btn-lg']) !!}
				</div>
			</div>
		</div>
	{!! Form::close() !!}
@stop