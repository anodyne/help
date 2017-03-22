<?php namespace Help\Data\Presenters;

use Gravatar,
	Markdown;
use Laracasts\Presenter\Presenter;

class UserPresenter extends Presenter {

	public function avatar(array $options)
	{
		// Figure out the default image
		$defaultImage = (app('env') != 'local') 
			? urlencode(asset('images/avatars/no-avatar.jpg')) 
			: 'retro' ;

		// Build the URL for the avatar
		$url = Gravatar::image(
			$this->entity->email,
			500,
			null,
			null,
			null,
			true
		)."&r=pg&d={$defaultImage}";
		//$url = Gravatar::image($this->entity->email, 500)."&r=pg&d={$defaultImage}";

		// Merge all the options to pass them to the partial
		$mergedOptions = $options + ['url' => $url];

		return view('partials.image')->with($mergedOptions);
	}

	public function bio()
	{
		return Markdown::parse($this->entity->bio);
	}

	public function email()
	{
		return $this->entity->email;
	}

	public function facebook()
	{
		return $this->entity->facebook;
	}

	public function facebookBtn($classes = 'btn btn-default')
	{
		if ( ! empty($this->entity->facebook))
		{
			return link_to($this->entity->facebook, "Facebook", ['class' => $classes, 'target' => '_blank']);
		}

		return false;
	}

	public function google()
	{
		return $this->entity->google;
	}

	public function googleBtn($classes = 'btn btn-default')
	{
		if ( ! empty($this->entity->google))
		{
			return link_to($this->entity->google, "Google+", ['class' => $classes, 'target' => '_blank']);
		}

		return false;
	}

	public function name()
	{
		return $this->entity->name;
	}

	public function siteBtn($classes = 'btn btn-default')
	{
		if ( ! empty($this->entity->url))
		{
			return link_to($this->entity->url, "Author's Website", ['class' => $classes, 'target' => '_blank']);
		}

		return false;
	}

	public function twitter()
	{
		return $this->entity->twitter;
	}

	public function twitterBtn($classes = 'btn btn-default')
	{
		if ( ! empty($this->entity->twitter))
		{
			return link_to('http://twitter.com/'.str_replace('@', '', $this->entity->twitter), 'Twitter', ['class' => $classes, 'target' => '_blank']);
		}

		return false;
	}

}
