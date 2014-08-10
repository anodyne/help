<?php namespace Help\Foundation\Data\Presenters;

use URL, HTML, View, Config, Markdown;
use Laracasts\Presenter\Presenter;

class ArticlePresenter extends Presenter {

	public function author()
	{
		return $this->entity->author->present()->name;
	}

	public function content()
	{
		return Markdown::parse($this->entity->content);
	}

	public function product()
	{
		return $this->entity->product->present()->name;
	}

	public function productLabel()
	{
		return View::make('partials.product')->withContent($this->product());
	}

	public function rating()
	{
		return (float) $this->entity->rating;
	}

	public function ratingLabel()
	{
		$type = 'danger';

		if ($this->rating() >= 4)
		{
			$type = 'info';
		}
		elseif ($this->rating() >= 2)
		{
			$type = 'warning';
		}

		return View::make('partials.label')
			->withType($type)
			->withContent(Config::get('icons.star').' '.$this->rating());
	}

	public function summary()
	{
		return Markdown::parse($this->entity->summary);
	}

	public function tags()
	{
		//
	}

	public function tagsLabel()
	{
		$output = '';

		foreach ($this->entity->tags as $tag)
		{
			$output.= View::make('partials.tag')->withContent($tag->name)." ";
		}

		return $output;
	}

	public function title()
	{
		return $this->entity->title;
	}

	public function titleWithLink()
	{
		return HTML::link(URL::route('article.show', [
			$this->entity->product->slug, $this->entity->slug
		]), $this->title());
	}

}
