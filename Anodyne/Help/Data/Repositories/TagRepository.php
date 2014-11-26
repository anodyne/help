<?php namespace Help\Data\Repositories;

use Tag,
	TagRepositoryInterface;

class TagRepository extends BaseRepository implements TagRepositoryInterface {

	protected $model;

	public function __construct(Tag $model)
	{
		$this->model = $model;
	}

}