<?php namespace Help\Foundation\Data\Presenters;

use Markdown;
use Laracasts\Presenter\Presenter;

class ProductPresenter extends Presenter {

	public function desc()
	{
		return Markdown::parse($this->entity->desc);
	}

	public function descRaw()
	{
		return $this->entity->desc;
	}

	public function name()
	{
		return $this->entity->name;
	}

}