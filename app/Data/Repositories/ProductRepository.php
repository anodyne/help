<?php namespace Help\Data\Repositories;

use Product as Model,
	ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface {

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
		// Get the product
		$product = $this->find($id);

		if ($product)
		{
			// Remove the product
			$product->delete();

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

	public function getProductArticles(Model $product)
	{
		return $product->articles;
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
		// Get the product
		$product = $this->find($id);

		if ($product)
		{
			// Fill the data
			$updatedItem = $product->fill($data);

			// Save the item
			$updatedItem->save();

			return $updatedItem;
		}

		return false;
	}

}
