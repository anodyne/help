<?php namespace Help\Data;

use Model;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model {

	use SoftDeletes, PresentableTrait;

	protected $table = 'articles_reviews';

	protected $fillable = ['article_id', 'user_id', 'type', 'notes', 'resolution',
		'comments'];

	protected $dates = ['created_at', 'updated_at', 'deleted_at'];

	protected $presenter = 'Help\Data\Presenters\ReviewPresenter';

	/*
	|---------------------------------------------------------------------------
	| Relationships
	|---------------------------------------------------------------------------
	*/

	public function article()
	{
		return $this->belongsTo('Article')->withTrashed();
	}

	public function author()
	{
		return $this->belongsTo('User', 'user_id');
	}

}
