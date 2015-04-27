<?php namespace Help\Data\Presenters;

use Markdown;
use Laracasts\Presenter\Presenter;

class ProductPresenter extends Presenter {

	public function description()
	{
		return Markdown::parse($this->entity->description);
	}

}
