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

	public function ratings()
	{
		return $this->hasMany('Rating');
	}

	public function reviews()
	{
		return $this->hasMany('Review')->withTrashed();
	}

	public function tags()
	{
		return $this->belongsToMany('Tag', 'articles_tags')->withTrashed();
	}

	/*
	|---------------------------------------------------------------------------
	| Model Scopes
	|---------------------------------------------------------------------------
	*/

	public function scopeProduct($query, $product)
	{
		$id = ($product instanceof Product) ? $product->id : $product;

		$query->where('product_id', $id);
	}

	public function scopeSlug($query, $slug)
	{
		$query->where('slug', $slug);
	}

	/*
	|---------------------------------------------------------------------------
	| Model Methods
	|---------------------------------------------------------------------------
	*/

	public function getUserRating(User $user)
	{
		return $this->ratings->filter(function($r) use ($user)
		{
			return (int) $r->user_id === (int) $user->id;
		})->first();
	}

	public function userHasRated(User $user)
	{
		if ($this->getUserRating($user)) return true;

		return false;
	}

}
