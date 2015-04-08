<?php namespace Help\Data\Presenters;

use Markdown;
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
		if ($this->entity->product) return $this->entity->product->present()->name;

		return false;
	}

	public function productAsLabel($one = false, $two = false)
	{
		if ($this->product())
		{
			return partial('product', [
				'content' => link_to_route('product', $this->product(), [$this->entity->product->slug])
			]);
		}

		return false;
	}

	public function rating()
	{
		# code...
	}

	public function ratingAsLabel()
	{
		return partial('rating', ['content' => 15]);
	}

	public function summary()
	{
		return Markdown::parse($this->entity->summary);
	}

	public function tags()
	{
		$outputArr = [];

		foreach ($this->entity->tags as $tag)
		{
			$outputArr[] = $tag->present()->name;
		}

		return implode(', ', $outputArr);
	}

	public function tagsAsLabel()
	{
		$outputArr = [];

		foreach ($this->entity->tags as $tag)
		{
			if ($tag)
			{
				$outputArr[] = partial('tag', [
					'content' => link_to_route('tag', $tag->present()->name, [$tag->slug])
				]);
			}
		}

		return implode(' ', $outputArr);
	}

	public function title()
	{
		return $this->entity->title;
	}

	public function titleWithLink()
	{
		return link_to_route('article.show', $this->title(), [$this->entity->product->slug, $this->entity->slug]);
		//return link_to('#', $this->title());
	}

}
