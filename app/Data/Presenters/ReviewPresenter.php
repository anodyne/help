<?php namespace Help\Data\Presenters;

use Markdown;
use Laracasts\Presenter\Presenter;

class ReviewPresenter extends Presenter {

	public function article()
	{
		return $this->entity->article->present()->title;
	}

	public function comments()
	{
		return Markdown::parse($this->entity->comments);
	}

	public function notes()
	{
		return Markdown::parse($this->entity->notes);
	}

	public function submitter()
	{
		return $this->entity->submitter->present()->name;
	}

	public function type($capitalize = false)
	{
		if ($capitalize) return ucwords($this->entity->type);

		return $this->entity->type;
	}

	public function typeAsLabel()
	{
		switch ($this->entity->type)
		{
			case 'correction':
				$type = 'danger';
			break;

			case 'suggestion':
				$type = 'success';
			break;

			default:
				$type = 'default';
		}

		return label($type, $this->type(true));
	}

}
