<?php namespace Help\Data\Models;

use Model;
use Laracasts\Presenter\PresentableTrait;

class Rating extends Model {

	use PresentableTrait;

	protected $table = 'ratings';

	protected $fillable = ['article_id', 'rating'];

	protected $dates = ['created_at', 'updated_at'];

	protected $presenter = 'Help\Foundation\Data\Presenters\RatingPresenter';

	/*
	|---------------------------------------------------------------------------
	| Relationships
	|---------------------------------------------------------------------------
	*/

	public function article()
	{
		return $this->belongsTo('Article', 'article_id');
	}

	/*
	|---------------------------------------------------------------------------
	| Model Scopes
	|---------------------------------------------------------------------------
	*/

	public function scopeArticle($query, $article)
	{
		$query->where('article_id', $article);
	}

}