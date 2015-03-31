<?php namespace Help\Data\Repositories;

use Tag as Model,
	TagRepositoryInterface;

class TagRepository extends BaseRepository implements TagRepositoryInterface {

	protected $model;

	public function __construct(Model $model)
	{
		$this->model = $model;
	}

	public function create(array $data)
	{
		return $this->model->create($data);
	}

	public function delete($id)
	{
		// Get the tag
		$tag = $this->getById($id);

		if ($tag)
		{
			// Remove the tag
			$tag->delete();

			return true;
		}

		return false;
	}

	public function getBySlug($slug)
	{
		return $this->getFirstBy('slug', $slug, ['articles', 'articles.product', 'articles.tags']);
	}

	public function getTagArticles(Model $tag)
	{
		return $tag->articles;
	}

	public function update($id, array $data)
	{
		// Get the tag
		$tag = $this->getById($id);

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
