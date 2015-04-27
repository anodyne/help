<?php namespace Help\Data;

use Model;
use Laracasts\Presenter\PresentableTrait;

class Rating extends Model {

	use PresentableTrait;

	public $timestamps = false;

	protected $table = 'articles_ratings';

	protected $fillable = ['article_id', 'user_id', 'rating'];

	protected $presenter = 'Help\Data\Presenters\RatingPresenter';

	/*
	|---------------------------------------------------------------------------
	| Relationships
	|---------------------------------------------------------------------------
	*/

	public function article()
	{
		return $this->belongsTo('Article');
	}

	public function author()
	{
		return $this->belongsTo('User', 'user_id');
	}

	/*
	|---------------------------------------------------------------------------
	| Model Scopes
	|---------------------------------------------------------------------------
	*/

	public function scopeGetArticle($query, Article $article)
	{
		$query->where('article_id', $article->id);
	}

	public function scopeGetUser($query, User $user)
	{
		$query->where('user_id', $user->id);
	}

}
