<?php namespace Help\Data\Repositories;

use Product,
	ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface {

	protected $model;

	public function __construct(Product $model)
	{
		$this->model = $model;
	}

}