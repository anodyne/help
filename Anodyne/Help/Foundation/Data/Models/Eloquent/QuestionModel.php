<?php namespace Help\Foundation\Data\Models\Eloquent;

use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class QuestionModel extends \Model {

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
		return $this->belongsTo('ArticleModel', 'article_id');
	}

	public function author()
	{
		return $this->belongsTo('UserModel', 'user_id');
	}

}