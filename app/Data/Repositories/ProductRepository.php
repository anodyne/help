<?php namespace Help\Data\Repositories;

use Product as Model,
	ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface {

	protected $model;

	public function __construct(Model $model)
	{
		$this->model = $model;
	}

}
