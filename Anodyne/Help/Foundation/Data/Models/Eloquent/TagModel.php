<?php namespace Help\Foundation\Data\Models\Eloquent;

use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class TagModel extends \Model {

	use PresentableTrait;
	use SoftDeletingTrait;

	protected $table = 'tags';

	protected $fillable = ['name', 'desc'];

	protected $dates = ['created_at', 'updated_at', 'deleted_at'];

	protected $presenter = 'Help\Foundation\Data\Presenters\TagPresenter';

	/*
	|---------------------------------------------------------------------------
	| Relationships
	|---------------------------------------------------------------------------
	*/

	public function articles()
	{
		return $this->belongsToMany('ArticleModel', 'articles_tags', 'tag_id', 'article_id');
	}

	public function products()
	{
		return $this->belongsToMany('ProductModel', 'products_tags', 'tag_id', 'product_id');
	}

}