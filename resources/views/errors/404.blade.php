@extends('layouts.master')

@section('title')
	Page Not Found
@stop

@section('content')
	<h1 class="text-danger">Page Not Found</h1>

	<p class="alert alert-danger">We couldn't find the page you're looking for. Please <a href="#" onclick="window.history.go(-1); return false;">go back</a> and try again. If you believe you've received this message in error, please <a href="#" class="js-contact">contact us</a> and let us know about the issue.</p>
@stop