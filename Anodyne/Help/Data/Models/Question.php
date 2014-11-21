<?php namespace Help\Data\Models;

use Model, SoftDeletingTrait;
use Laracasts\Presenter\PresentableTrait;

class Question extends Model {

	use PresentableTrait;
	use SoftDeletingTrait;

	protected $table = 'questions';

	protected $fillable = ['user_id', 'article_id', 'title', 'question', 'answered'];

	protected $dates = ['created_at', 'updated_at', 'deleted_at'];

	protected $presenter = 'Help\Foundation\Data\Presenters\QuestionPresenter';

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

}