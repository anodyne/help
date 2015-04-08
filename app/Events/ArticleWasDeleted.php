<?php namespace Help\Events;

use Help\Events\Event;
use Illuminate\Queue\SerializesModels;

class ArticleWasDeleted extends Event {

	use SerializesModels;

	protected $id;
	protected $title;

	public function __construct($id, $title)
	{
		$this->id = $id;
		$this->title = $title;
	}

}
