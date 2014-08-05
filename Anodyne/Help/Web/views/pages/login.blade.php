@extends('layouts.master')

@section('title')
	Log In
@stop

@section('content')
	<div class="row">
		<div class="col-md-8 col-lg-6 col-md-offset-2 col-lg-offset-3">
			<h1>Log In</h1>

			<p>AnodyneXtras is the one-stop-shop to find skins, MODs, and rank sets created by Anodyne Productions and the wider Anodyne community. From here you can share, search for, and download items to make your Nova sim more unique.</p>

			<hr>

			{{ Form::open(array('url' => 'login')) }}
				<div class="form-group{{ ($errors->has('email')) ? ' has-error' : '' }}">
					<label>Email Address</label>
					{{ Form::text('email', null, array('type' => 'email', 'class' => 'form-control input-with-feedback input-lg')) }}
					{{ $errors->first('email', '<p class="help-block">:message</p>') }}
				</div>

				<div class="form-group{{ ($errors->has('password')) ? ' has-error' : '' }}">
					<label>Password</label>
					{{ Form::password('password', array('class' => 'form-control input-with-feedback input-lg')) }}
					{{ $errors->first('password', '<p class="help-block">:message</p>') }}
				</div>

				<div class="form-group">
					{{ Form::button('Log In', ['type' => 'submit', 'class' => 'btn btn-lg btn-block btn-primary']) }}
					<a href="{{ route('register') }}" class="btn btn-block btn-link">Register Now</a>
				</div>
			{{ Form::close() }}
		</div>
	</div>
@stop