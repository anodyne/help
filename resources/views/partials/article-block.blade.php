<div class="article-block">
	<a href="{{ route('article.show', [$article->product->slug, $article->slug]) }}" class="article-title">{!! $article->present()->title !!}</a>
	<p>
		@if ($rating and $article->ratings->count() > 0)
			{!! $article->present()->ratingAsLabel !!}
		@endif
		{!! $article->present()->productAsLabel !!}
		{!! $article->present()->tagsAsLabel !!}
	</p>
	{!! $article->present()->summary !!}
</div>