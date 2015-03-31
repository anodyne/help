<?php namespace Help\Data\Repositories;

use Product as Model,
	ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface {

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
		// Get the product
		$product = $this->getById($id);

		if ($product)
		{
			// Remove the product
			$product->delete();

			return true;
		}

		return false;
	}

	public function getBySlug($slug)
	{
		return $this->getFirstBy('slug', $slug, ['articles', 'articles.product', 'articles.tags']);
	}

	public function getProductArticles(Model $product)
	{
		return $product->articles;
	}

	public function update($id, array $data)
	{
		// Get the product
		$product = $this->getById($id);

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
