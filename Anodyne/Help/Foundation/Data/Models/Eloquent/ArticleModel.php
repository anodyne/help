<?php namespace Help\Foundation\Data\Models\Eloquent;

use Str, ProductModel, SoftDeletingTrait;
use Laracasts\Presenter\PresentableTrait;

class ArticleModel extends \Model {

	use PresentableTrait;
	use SoftDeletingTrait;

	protected $table = 'articles';

	protected $fillable = ['user_id', 'product_id', 'title', 'summary', 'slug',
		'content', 'status', 'rating'];

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

	public function comments()
	{
		return $this->hasMany('CommentModel', 'article_id')->orderBy('created_at');
	}

	/*
	|---------------------------------------------------------------------------
	| Model Scopes
	|---------------------------------------------------------------------------
	*/

	public function scopeSlug($query, $slug)
	{
		$query->where('articles.slug', 'like', "%{$slug}%");
	}

	public function scopeProduct($query, $product)
	{
		// Find the product ID
		$product = ProductModel::where('slug', $product)->first();

		// Do the query
		$query->where('product_id', $product->id);
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

	/*
	|---------------------------------------------------------------------------
	| Model Methods
	|---------------------------------------------------------------------------
	*/

	public function getRating()
	{
		$rating = 0;

		if ($this->ratings->count() > 0)
		{
			foreach ($this->ratings as $r)
			{
				$rating += $r->rating;
			}

			return (float) round($rating/$this->ratings->count(), 2);
		}

		return $rating;
	}

}
