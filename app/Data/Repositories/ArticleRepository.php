<?php namespace Help\Data\Repositories;

use Article as Model,
	ArticleRepositoryInterface;

class ArticleRepository extends BaseRepository implements ArticleRepositoryInterface {

	protected $model;

	public function __construct(Model $model)
	{
		$this->model = $model;
	}

	public function allWithTrashed(array $with = [])
	{
		$query = $this->make($with);

		return $query->withTrashed()->get();
	}

	public function checkForDuplicateSlugs($product, $slug)
	{
		// Build the product repo
		$productRepo = app('ProductRepository');

		// Get the product
		$product = $productRepo->find($product);

		// Get all its articles
		$articles = $productRepo->getProductArticles($product);

		// Filter to just this slug
		$articleCount = $articles->filter(function($a) use ($slug)
		{
			return $a->slug == $slug;
		})->count();

		if ($articleCount > 0) return true;

		return false;
	}

	public function create(array $data)
	{
		// Create the article
		$article = $this->model->create($data);

		// Sync the tags
		if (array_key_exists('tags', $data))
		{
			$article->tags()->sync($data['tags']);
		}

		return $article;
	}

	public function find($id)
	{
		$query = $this->make(['tags', 'product', 'author']);

		return $query->where('id', '=', $id)->withTrashed()->first();
	}

	public function getLatestArticles($number = 5)
	{
		return $this->model->with(['tags', 'product', 'author'])
			->latest()->limit($number)->get();
	}

	public function update($id, array $data)
	{
		// Get the article
		$article = $this->find($id);

		if ($article)
		{
			// Fill the article with the new info
			$article->fill($data);

			// Save the article
			$article->save();

			if (array_key_exists('tags', $data))
			{
				// Reset the tags
				//$article->tags()->sync([]);

				// Update the tags
				$article->tags()->sync($data['tags']);
			}

			return $article;
		}

		return false;
	}

}
