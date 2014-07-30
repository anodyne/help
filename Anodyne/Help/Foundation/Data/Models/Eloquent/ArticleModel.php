<?php namespace Help\Foundation\Data\Models\Eloquent;

use Str;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ArticleModel extends \Model {

	use PresentableTrait;
	use SoftDeletingTrait;

	protected $table = 'articles';

	protected $fillable = ['user_id', 'product_id', 'title', 'summary', 'slug',
		'content', 'status'];

	protected $dates = ['created_at', 'updated_at', 'deleted_at'];

	protected $presenter = 'Help\Foundation\Data\Presenters\ArticlePresenter';

	/*
	|---------------------------------------------------------------------------
	| Relationships
	|---------------------------------------------------------------------------
	*/

	public function tags()
	{
		return $this->belongsToMany('TagModel', 'articles_tags', 'article_id', 'tag_id');
	}

	public function author()
	{
		return $this->belongsTo('UserModel', 'user_id');
	}

	public function flags()
	{
		return $this->hasMany('FlagModel', 'article_id');
	}

	public function question()
	{
		return $this->hasOne('QuestionModel', 'article_id');
	}

	public function product()
	{
		return $this->belongsTo('ProductModel', 'product_id');
	}

	public function ratings()
	{
		return $this->hasMany('RatingModel', 'article_id');
	}

	/*
	|---------------------------------------------------------------------------
	| Model Accessors/Mutators
	|---------------------------------------------------------------------------
	*/

	public function setSlugAttribute($value)
	{
		$this->attributes['slug'] = ( ! empty($value)) 
			? $value 
			: Str::slug(Str::lower($this->attributes['title']));
	}

}