<?php namespace Help\Data;

use Str, Model;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model {

	use SoftDeletes, PresentableTrait;

	protected $table = 'articles';

	protected $fillable = ['product_id', 'user_id', 'title', 'slug', 'summary',
		'content'];

	protected $dates = ['created_at', 'updated_at', 'deleted_at'];

	protected $presenter = 'Help\Data\Presenters\ArticlePresenter';

	/*
	|---------------------------------------------------------------------------
	| Accessors/Mutators
	|---------------------------------------------------------------------------
	*/

	public function setSlugAttribute($value)
	{
		$this->attributes['slug'] = (empty($value))
			? Str::slug($this->attributes['title'])
			: $value;
	}

	/*
	|---------------------------------------------------------------------------
	| Relationships
	|---------------------------------------------------------------------------
	*/

	public function author()
	{
		return $this->belongsTo('User', 'user_id');
	}

	public function product()
	{
		return $this->belongsTo('Product')->withTrashed();
	}

	public function tags()
	{
		return $this->belongsToMany('Tag', 'articles_tags')->withTrashed();
	}

}
