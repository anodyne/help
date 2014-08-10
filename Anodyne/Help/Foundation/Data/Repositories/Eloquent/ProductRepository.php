<?php namespace Help\Foundation\Data\Repositories\Eloquent;

use ProductModel,
	ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface {

	public function all($value = false, $id = false)
	{
		if ( ! $value)
		{
			return ProductModel::with('tags')->get();
		}

		return ProductModel::lists($value, $id);
	}

}