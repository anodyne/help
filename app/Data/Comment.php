<?php namespace Help\Data;

use Model, SoftDeletingTrait;
use Laracasts\Presenter\PresentableTrait;

class Comment extends Model {

	use PresentableTrait;
	use SoftDeletingTrait;

	protected $table = 'comments';

	protected $fillable = ['user_id', 'article_id', 'content'];

	protected $dates = ['created_at', 'updated_at', 'deleted_at'];

	protected $presenter = 'Help\Data\Presenters\CommentPresenter';

	/*
	|---------------------------------------------------------------------------
	| Relationships
	|---------------------------------------------------------------------------
	*/

	public function article()
	{
		return $this->belongsTo('Article', 'article_id');
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

	public function scopeArticle($query, $id)
	{
		$query->where('article_id', $id);
	}

}