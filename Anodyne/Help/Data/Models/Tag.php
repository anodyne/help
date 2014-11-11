<?php namespace Help\Data\Models;

use Model, SoftDeletingTrait;
use Laracasts\Presenter\PresentableTrait;

class Tag extends Model {

	use PresentableTrait;
	use SoftDeletingTrait;

	protected $table = 'tags';

	protected $fillable = ['name', 'desc'];

	protected $dates = ['created_at', 'updated_at', 'deleted_at'];

	protected $presenter = 'Help\Data\Presenters\TagPresenter';

	/*
	|---------------------------------------------------------------------------
	| Relationships
	|---------------------------------------------------------------------------
	*/

	public function articles()
	{
		return $this->belongsToMany('Article', 'articles_tags', 'tag_id', 'article_id');
	}

	public function products()
	{
		return $this->belongsToMany('Product', 'products_tags', 'tag_id', 'product_id');
	}

}