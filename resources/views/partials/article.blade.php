<dt>{!! $article->present()->titleWithLink !!}</dt>
<dd>
	@if ($rating and $article->ratings->count() > 0)
		{!! $article->present()->ratingAsLabel !!}
	@endif
	{!! $article->present()->productAsLabel !!}
	{!! $article->present()->tagsAsLabel !!}
</dd>
<dd class="text-sm">{!! $article->present()->summary !!}</dd>