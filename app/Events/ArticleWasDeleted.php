<?php namespace Help\Events;

use Article;
use Help\Events\Event;
use Illuminate\Queue\SerializesModels;

class ArticleWasDeleted extends Event {

	use SerializesModels;

	protected $article;

	public function __construct(Article $article)
	{
		$this->article = $article;
	}

}
