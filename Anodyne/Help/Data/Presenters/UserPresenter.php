<?php namespace Help\Data\Presenters;

use URL,
	HTML,
	View,
	Markdown;
use Laracasts\Presenter\Presenter;

class UserPresenter extends Presenter {

	public function avatar(array $options)
	{
		// Figure out the default image
		$defaultImage = (App::environment() != 'local') 
			? urlencode(asset('images/avatars/no-avatar.jpg')) 
			: 'retro' ;

		// Build the URL for the avatar
		$url = Gravatar::image($this->entity->email, 500)."&r=pg&d={$defaultImage}";

		// Merge all the options to pass them to the partial
		$mergedOptions = $options + ['url' => $url];

		return View::make('partials.image')->with($mergedOptions);
	}

	public function bio()
	{
		return Markdown::parse($this->entity->bio);
	}

	public function email()
	{
		return $this->entity->email;
	}

	public function itemsMods()
	{
		return $this->entity->items->filter(function($i)
		{
			return $i->type->name == 'MOD';
		})->sortBy(function($s){
			return $s->updated_at;
		});
	}

	public function itemsRanks()
	{
		return $this->entity->items->filter(function($i)
		{
			return $i->type->name == 'Rank Set';
		})->sortBy(function($s){
			return $s->updated_at;
		});
	}

	public function itemsSkins()
	{
		return $this->entity->items->filter(function($i)
		{
			return $i->type->name == 'Skin';
		})->sortBy(function($s){
			return $s->updated_at;
		});
	}

	public function name()
	{
		return $this->entity->name;
	}

	public function siteBtn()
	{
		if ( ! empty($this->entity->url))
		{
			return HTML::link($this->entity->url, "Author's Website", ['class' => 'btn btn-default']);
		}

		return false;
	}

}