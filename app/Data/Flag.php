<?php namespace Help\Data;

use Model, SoftDeletingTrait;
use Laracasts\Presenter\PresentableTrait;

class Flag extends Model {

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
		return $this->belongsTo('Article', 'article_id');
	}

	public function user()
	{
		return $this->belongsTo('User', 'user_id');
	}

}