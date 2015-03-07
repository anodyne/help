<?php namespace Help\Data\Repositories;

use Tag as Model,
	TagRepositoryInterface;

class TagRepository extends BaseRepository implements TagRepositoryInterface {

	protected $model;

	public function __construct(Model $model)
	{
		$this->model = $model;
	}

}
