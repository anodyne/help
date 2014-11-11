<?php namespace Help\Data\Transformers;

use Comment;
use League\Fractal;

class CommentTransformer extends Fractal\TransformerAbstract {

	public function transform(Comment $comment)
	{
		return [
			'id'		=> (int) $comment->id,
			'author'	=> $comment->present()->author,
			'article'	=> (int) $comment->article->id,
			'content'	=> $comment->present()->content,
		];
	}
}