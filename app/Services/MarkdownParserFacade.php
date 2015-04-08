<?php namespace Help\Services;

use Illuminate\Support\Facades\Facade;

class MarkdownParserFacade extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return 'markdown'; }

}
