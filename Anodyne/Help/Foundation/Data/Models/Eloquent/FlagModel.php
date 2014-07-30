<?php namespace Help\Foundation\Data\Models\Eloquent;

use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class FlagModel extends \Model {

	use PresentableTrait;
	use SoftDeletingTrait;

	protected $table = 'articles_flags';

	protected $fillable = ['article_id', 'user_id', 'type', 'notes', 'resolved'];

	protected $dates = ['created_at', 'updated_at', 'deleted_at'];

	protected $presenter = 'Help\Foundation\Data\Presenters\FlagPresenter';

	/*
	|---------------------------------------------------------------------------
	| Relationships
	|---------------------------------------------------------------------------
	*/

	public function article()
	{
		return $this->belongsTo('ArticleModel', 'article_id');
	}

	public function user()
	{
		return $this->belongsTo('UserModel', 'user_id');
	}

}