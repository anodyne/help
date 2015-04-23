<?php namespace Help\Data\Transformers;

use Article;
use League\Fractal;

class ArticleTransformer extends Fractal\TransformerAbstract {

	public function transform(Article $article)
	{
		$tags = [];

		foreach ($article->tags as $tag)
		{
			$tags[] = $tag->present()->name;
		}

		return [
			'id'			=> (int) $article->id,
			'title'			=> $article->present()->title,
			'slug'			=> $article->present()->slug,
			'summary'		=> $article->present()->summary,
			'content'		=> $article->present()->content,
			'author'		=> $article->present()->author,
			'userId'		=> (int) $article->user_id,
			'product'		=> $article->present()->product,
			'productId'		=> (int) $article->product_id,
			'isTrashed'		=> (bool) $article->trashed(),
			'links'			=> [
				'edit'		=> route('admin.article.edit', [$article->id]),
				'view'		=> route('article.show', [$article->product->slug, $article->slug]),
			],
			'tags'			=> (array) $tags,
		];
	}

}
