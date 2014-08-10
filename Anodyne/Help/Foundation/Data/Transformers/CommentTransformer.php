<?php namespace Help\Foundation\Data\Transformers;

use CommentModel;
use League\Fractal;

class CommentTransformer extends Fractal\TransformerAbstract {

	public function transform(CommentModel $comment)
	{
		return [
			'id'		=> (int) $comment->id,
			'author'	=> $comment->present()->author,
			'article'	=> (int) $comment->article->id,
			'content'	=> $comment->present()->content,
		];
	}
}