@extends('layouts.email')

@section('content')
	{!! Markdown::parse($content) !!}
@stop