<?php namespace Help\Events;

use Review;
use Help\Events\Event;
use Illuminate\Queue\SerializesModels;

class ReviewWasCreated extends Event {

	use SerializesModels;

	protected $review;

	public function __construct(Review $review)
	{
		$this->review = $review;
	}

	public function getReview()
	{
		return $this->review;
	}

}
