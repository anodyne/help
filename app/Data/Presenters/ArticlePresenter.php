<?php namespace Help\Data\Presenters;

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

	public function created()
	{
		return $this->entity->created_at->format('d F Y');
	}

	public function helpfulFull()
	{
		$helpful = 9;
		$total = 11;

		return "{$helpful} out of {$total}";
	}

	public function product()
	{
		return $this->entity->product->present()->name;
	}

	public function productLabel()
	{
		return View::make('partials.product')
			->withContent(HTML::linkRoute('product', $this->product(), [$this->entity->product->slug]));
	}

	public function rating()
	{
		return (float) round($this->entity->rating, 2);
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

	public function tagsLabel($newline = false)
	{
		$output = '';

		foreach ($this->entity->tags as $tag)
		{
			$output.= View::make('partials.tag')
				->withContent(HTML::linkRoute('tag', $tag->present()->name, [$tag->slug]))." ";
			$output.= ($newline) ? "<br>" : "";
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

	public function updated()
	{
		return $this->entity->updated_at->format('d F Y');
	}

}
