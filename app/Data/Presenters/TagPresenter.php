<?php namespace Help\Data\Presenters;

use Markdown;
use Laracasts\Presenter\Presenter;

class TagPresenter extends Presenter {

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

	public function slug()
	{
		return $this->entity->slug;
	}

}
