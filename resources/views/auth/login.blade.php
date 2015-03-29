@extends('layouts.master')

@section('title')
	Log In
@stop

@section('content')
	<div class="row">
		<div class="col-md-8 col-lg-6 col-md-offset-2 col-lg-offset-3">
			<h1>Log In</h1>

			<p>The Anodyne Help Center is the one-stop-shop to get support for any of Anodyne's products. Whether you're looking for tutorials, frequently asked questions, or guides for how to do things, make sure you search through the Help Center to get the answers you need!</p>

			<hr>

			{!! Form::open(['url' => 'login']) !!}
				<div class="form-group{{ ($errors->has('email')) ? ' has-error' : '' }}">
					<label class="control-label">Email Address</label>
					{!! Form::text('email', null, ['type' => 'email', 'class' => 'form-control input-lg']) !!}
					{!! $errors->first('email', '<p class="help-block">:message</p>') !!}
				</div>

				<div class="form-group{{ ($errors->has('password')) ? ' has-error' : '' }}">
					<label class="control-label">Password</label>
					{!! Form::password('password', ['class' => 'form-control input-lg']) !!}
					{!! $errors->first('password', '<p class="help-block">:message</p>') !!}
				</div>

				<div class="form-group">
					{!! Form::button('Log In', ['type' => 'submit', 'class' => 'btn btn-lg btn-block btn-primary']) !!}
					<a href="{{ config('anodyne.links.www') }}register" class="btn btn-block btn-link">Register Now</a>
					<a href="{{ config('anodyne.links.www') }}password/remind" class="btn btn-block btn-link">Forgot Password?</a>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
@stop