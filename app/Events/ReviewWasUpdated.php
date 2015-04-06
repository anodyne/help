<?php namespace Help\Events;

use Review;
use Help\Events\Event;
use Illuminate\Queue\SerializesModels;

class ReviewWasUpdated extends Event {

	use SerializesModels;

	protected $review;

	public function __construct(Review $review)
	{
		$this->review = $review;
	}

}
