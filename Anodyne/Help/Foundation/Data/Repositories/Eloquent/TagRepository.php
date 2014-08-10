<?php namespace Help\Foundation\Data\Repositories\Eloquent;

use TagModel,
	TagRepositoryInterface;

class TagRepository implements TagRepositoryInterface {

	public function all($value = false, $id = false)
	{
		if ( ! $value)
		{
			return TagModel::with('product', 'articles')->get();
		}

		return TagModel::lists($value, $id);
	}

}