<?php namespace Help\Data\Repositories;

use Product,
	ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface {

	public function all($value = false, $id = false)
	{
		if ( ! $value)
		{
			return Product::with('tags')->get();
		}

		return Product::lists($value, $id);
	}

}