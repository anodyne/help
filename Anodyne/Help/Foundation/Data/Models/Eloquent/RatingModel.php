<?php namespace Help\Foundation\Data\Models\Eloquent;

use Laracasts\Presenter\PresentableTrait;

class ItemRatingModel extends \Model {

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
		return $this->belongsTo('ArticleModel', 'article_id');
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