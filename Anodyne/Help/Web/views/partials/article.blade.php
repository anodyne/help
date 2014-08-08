<dt>{{ $article->present()->titleWithLink }}</dt>
<dd>{{ $article->present()->summary }}</dd>
<dd>
	@if ($rating and $article->ratings->count() > 0)
		{{ $article->present()->ratingLabel }}
	@endif
	{{ $article->present()->productLabel }}
	{{ $article->present()->tagsLabel }}
</dd>
