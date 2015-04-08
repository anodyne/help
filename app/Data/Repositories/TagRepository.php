<?php namespace Help\Data\Repositories;

use Tag as Model,
	TagRepositoryInterface;

class TagRepository extends BaseRepository implements TagRepositoryInterface {

	protected $model;

	public function __construct(Model $model)
	{
		$this->model = $model;
	}

	public function allWithTrashed()
	{
		return $this->model->withTrashed()->get();
	}

	public function create(array $data)
	{
		return $this->model->create($data);
	}

	public function delete($id)
	{
		// Get the tag
		$tag = $this->find($id);

		if ($tag)
		{
			// Remove the tag
			$tag->delete();

			return true;
		}

		return false;
	}

	public function find($id)
	{
		$query = $this->make(['articles']);

		return $query->where('id', '=', $id)->withTrashed()->first();
	}

	public function getBySlug($slug)
	{
		return $this->make(['articles', 'articles.product', 'articles.tags'])
			->where('slug', '=', $slug)
			->withTrashed()
			->first();
	}

	public function getTagArticles(Model $tag)
	{
		return $tag->articles;
	}

	public function restore($id)
	{
		// Get the tag
		$tag = $this->find($id);

		if ($tag)
		{
			if ($tag->trashed())
			{
				$item = $tag->restore();

				return $tag;
			}
		}

		return false;
	}

	public function update($id, array $data)
	{
		// Get the tag
		$tag = $this->find($id);

		if ($tag)
		{
			// Fill the data
			$updatedItem = $tag->fill($data);

			// Save the item
			$updatedItem->save();

			return $updatedItem;
		}

		return false;
	}

}
