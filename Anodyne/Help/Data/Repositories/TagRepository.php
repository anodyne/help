<?php namespace Help\Data\Repositories;

use Tag,
	TagRepositoryInterface;

class TagRepository implements TagRepositoryInterface {

	public function all($value = false, $id = false)
	{
		if ( ! $value)
		{
			return Tag::with('product', 'articles')->get();
		}

		return Tag::lists($value, $id);
	}

}