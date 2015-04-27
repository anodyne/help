@extends('layouts.email')

@section('content')
	@if ($type == 'suggestion')
		<p>{{ $user }} has suggested a change to the {{ $product }} article "{{ $article }}" with the following comments:</p>
	@elseif ($type == 'review')
		<p>{{ $user }} has requested a review of the {{ $product }} article "{{ $article }}" with the following comments:</p>
	@else
		<p>{{ $user }} has identified changes to the {{ $product }} article "{{ $article }}" with the following comments:</p>
	@endif

	@if ( ! empty($comments))
		<em>{!! Markdown::parse($comments) !!}</em>
	@else
		<p><em>No comments provided.</em></p>
	@endif

	<p><a href="{{ $link }}">{{ $article }}</a></p>
@stop