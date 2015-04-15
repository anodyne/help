@extends('layouts.email')

@section('content')
	<p>The review of the {{ $product }} article "{{ $article }}" has been completed.</p>

	@if ($resolution == "fixed")
		<p>We have made updates to the article and those changes are now live on the Help Center. You can view the changes by going to the <a href="{{ $link }}">article page</a>. If there are further issues you see, please don't hesitate to send additional review requests.</p>
	@else
		<p>After review, we have determined that no changes are necessary to this article.</p>
	@endif

	@if ( ! empty($notes))
		<p><strong>Notes:</strong></p>

		{!! Markdown::parse($notes) !!}
	@endif

	<p>Thank you for your article review submission!</p>
@stop