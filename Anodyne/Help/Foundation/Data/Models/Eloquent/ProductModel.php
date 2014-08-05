<?php namespace Help\Foundation\Data\Models\Eloquent;

use SoftDeletingTrait;
use Laracasts\Presenter\PresentableTrait;

class ProductModel extends \Model {

	use PresentableTrait;
	use SoftDeletingTrait;

	protected $table = 'products';

	protected $fillable = ['name', 'desc'];

	protected $dates = ['created_at', 'updated_at', 'deleted_at'];

	protected $presenter = 'Help\Foundation\Data\Presenters\ProductPresenter';

	/*
	|---------------------------------------------------------------------------
	| Relationships
	|---------------------------------------------------------------------------
	*/

	public function tags()
	{
		return $this->belongsToMany('TagModel', 'products_tags', 'product_id', 'tag_id');
	}

}