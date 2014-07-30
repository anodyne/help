<?php namespace Help\Foundation\Data\Models\Eloquent;

use SoftDeletingTrait;
use Laracasts\Presenter\PresentableTrait;

class CommentModel extends \Model {

	use PresentableTrait;
	use SoftDeletingTrait;

	protected $table = 'comments';

	protected $fillable = ['user_id', 'article_id', 'content'];

	protected $dates = ['created_at', 'updated_at', 'deleted_at'];

	protected $presenter = 'Help\Foundation\Data\Presenters\CommentPresenter';

	/*
	|---------------------------------------------------------------------------
	| Relationships
	|---------------------------------------------------------------------------
	*/

	public function article()
	{
		return $this->belongsTo('ArticleModel', 'article_id');
	}

	public function author()
	{
		return $this->belongsTo('UserModel', 'user_id');
	}

}