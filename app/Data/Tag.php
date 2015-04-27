<?php namespace Help\Data;

use Str, Model;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model {

	use SoftDeletes, PresentableTrait;

	protected $table = 'tags';

	protected $fillable = ['name', 'slug', 'display'];

	protected $dates = ['created_at', 'updated_at', 'deleted_at'];

	protected $presenter = 'Help\Data\Presenters\TagPresenter';

	/*
	|---------------------------------------------------------------------------
	| Accessors/Mutators
	|---------------------------------------------------------------------------
	*/

	public function setSlugAttribute($value)
	{
		$this->attributes['slug'] = (empty($value))
			? Str::slug($this->attributes['name'])
			: $value;
	}

	/*
	|---------------------------------------------------------------------------
	| Relationships
	|---------------------------------------------------------------------------
	*/

	public function articles()
	{
		return $this->belongsToMany('Article', 'articles_tags')->published();
	}

}
