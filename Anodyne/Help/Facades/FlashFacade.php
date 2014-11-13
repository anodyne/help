<?php namespace Help\Facades;

use Illuminate\Support\Facades\Facade;

class FlashFacade extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return 'flash'; }

}