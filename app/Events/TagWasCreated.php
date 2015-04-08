<?php namespace Help\Events;

use Tag;
use Help\Events\Event;
use Illuminate\Queue\SerializesModels;

class TagWasCreated extends Event {

	use SerializesModels;

	protected $tag;

	public function __construct(Tag $tag)
	{
		$this->tag = $tag;
	}

}
