@extends('layouts.master')

@section('title')
	Article Not Found
@stop

@section('content')
	<h1 class="text-danger">Article Not Found</h1>

	<p class="alert alert-danger">We couldn't find the article you're looking for. Please <a href="#" onclick="window.history.go(-1); return false;">go back</a> and try again. If you believe you've received this message in error, please <a href="#" class="js-contact">contact us</a> and let us know about the issue.</p>
@stop