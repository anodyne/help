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

	public function delete($id)
	{
		// Get the article
		$article = $this->find($id);

		if ($article)
		{
			// Remove the article
			$article->delete();

			return $article;
		}

		return false;
	}

	public function find($id)
	{
		$query = $this->make(['tags', 'product', 'author', 'ratings']);

		return $query->where('id', '=', $id)->withTrashed()->first();
	}

	public function getByProductAndSlug($product, $slug)
	{
		// Get the product
		$product = app('ProductRepository')->getBySlug($product);

		if ($product)
		{
			return $this->model->with(['tags', 'product', 'author', 'ratings'])
				->product($product)
				->slug($slug)
				->first();
		}
	}

	public function getLatestArticles($number = 5)
	{
		return $this->model->with(['tags', 'product', 'author'])
			->latest()->limit($number)->get();
	}

	public function getMostHelpfulArticles($number = 5)
	{
		// Get all the articles that have ratings
		$articles = $this->model->has('ratings')->get();

		return $articles->sortByDesc(function($a)
		{
			return $a->getHelpfulRatings()->count() / $a->ratings->count() * 100;
		});
	}

	public function restore($id)
	{
		// Get the article
		$article = $this->find($id);

		if ($article)
		{
			if ($article->trashed())
			{
				$item = $article->restore();

				return $article;
			}
		}

		return false;
	}

	public function search($input)
	{
		return $this->model->with('author', 'product', 'tags')
			->where(function($query) use ($input)
			{
				$query->where('title', 'like', "%{$input}%")
					->orWhere('summary', 'like', "%{$input}%")
					->orWhere('content', 'like', "%{$input}%");
			})->paginate(25);
	}

	public function searchAdvanced(array $input)
	{
		$search = $this->make(['author', 'product', 'tags']);

		if (array_key_exists('p', $input) and count($input['p']) > 0)
		{
			$search = $search->whereIn('product_id', $input['p']);
		}

		if (array_key_exists('t', $input) and count($input['t']) > 0)
		{
			$search = $search->whereHas('tags', function($query) use ($input)
			{
				$query->whereIn('id', $input['t']);
			});
		}

		if ( ! empty($input['q']))
		{
			$search = $search->where(function($query) use ($input)
			{
				$query->where('title', 'like', "%{$input['q']}%")
					->orWhere('summary', 'like', "%{$input['q']}%")
					->orWhere('content', 'like', "%{$input['q']}%");
			});
		}

		return $search->paginate(25);
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
