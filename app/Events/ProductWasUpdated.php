<?php namespace Help\Events;

use Product;
use Help\Events\Event;
use Illuminate\Queue\SerializesModels;

class ProductWasUpdated extends Event {

	use SerializesModels;

	protected $product;

	public function __construct(Product $product)
	{
		$this->product = $product;
	}

}
