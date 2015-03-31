<dt>{!! $article->present()->titleWithLink !!}</dt>
<dd class="text-sm text-muted">by {!! $article->present()->author !!}</dd>
<dd>{{ $article->present()->summary }}</dd>
<dd>
	@if ($rating and $article->ratings->count() > 0)
		{!! $article->present()->ratingAsLabel !!}
	@endif
	{!! $article->present()->productAsLabel !!}
	{!! $article->present()->tagsAsLabel !!}
</dd>
