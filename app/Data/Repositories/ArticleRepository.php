<?php namespace Help\Data\Repositories;

use Comment,
	Article as Model,
	ArticleRepositoryInterface;

class ArticleRepository extends BaseRepository implements ArticleRepositoryInterface {

	protected $model;

	public function __construct(Model $model)
	{
		$this->model = $model;
	}

	public function findByProductAndSlug($product, $slug)
	{
		return $this->make(['tags', 'product', 'author', 'ratings', 'comments', 'comments.author'])
			->product($product)
			->slug($slug)
			->get();
	}

	public function getByProduct($product)
	{
		return $this->make(['tags', 'product', 'author', 'ratings'])
			->product($product)
			->orderBy('rating', 'desc')
			->get();
	}

	public function getComments($id)
	{
		return Comment::with('author')->article($id)->get();
	}

	public function getPopular($number)
	{
		return $this->make(['tags', 'product', 'author', 'ratings'])
			->orderBy('rating', 'desc')
			->take($number)
			->get();
	}

	public function getLatest($number)
	{
		return $this->make(['tags', 'product', 'author', 'ratings'])
			->orderBy('created_at', 'desc')
			->take($number)
			->get();
	}

	public function getByTag($tag)
	{
		return $this->make(['tags', 'product', 'author', 'ratings'])
			->tag($tag)
			->orderBy('rating', 'desc')
			->get();
	}

	/**
	 * Search for an item by its name and/or description and paginate the
	 * results.
	 *
	 * @param	string	$input
	 * @return	Paginator
	 */
	public function search($input)
	{
		return $this->make(['tags', 'product', 'author', 'ratings'])
			->where(function($query) use ($input)
			{
				$query->where('title', 'like', "%{$input}%")
					->orWhere('summary', 'like', "%{$input}%")
					->orWhere('content', 'like', "%{$input}%");
			})->active()->paginate(25);
	}

	/**
	 * Do an advanced search for items based on multiple criteria and paginate
	 * the results.
	 *
	 * @param	array	$input
	 * @return	Paginator
	 */
	public function searchAdvanced(array $input)
	{
		$search = Article::query()->with('product', 'type', 'user');

		if (array_key_exists('t', $input) and count($input['t']) > 0)
		{
			$search = $search->whereIn('type_id', $input['t']);
		}

		if (array_key_exists('p', $input) and count($input['p']) > 0)
		{
			$search = $search->whereIn('product_id', $input['p']);
		}

		if ( ! empty($input['q']))
		{
			$search = $search->where(function($query) use ($input)
			{
				$query->where('name', 'like', "%{$input['q']}%")
					->orWhere('desc', 'like', "%{$input['q']}%");
			});
		}

		return $search->active()->paginate(25);
	}

}
