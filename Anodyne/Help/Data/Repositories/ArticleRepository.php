<?php namespace Help\Data\Repositories;

use Article,
	Comment,
	ArticleRepositoryInterface;

class ArticleRepository implements ArticleRepositoryInterface {

	public function findByProductAndSlug($product, $slug)
	{
		return Article::with('tags', 'product', 'author', 'ratings', 'comments', 'comments.author')
			->product($product)->slug($slug)->get();
	}

	public function getByProduct($product)
	{
		return Article::with('tags', 'product', 'author', 'ratings')
			->product($product)->orderBy('rating', 'desc')->get();
	}

	public function getComments($id)
	{
		return Comment::with('author')->article($id)->get();
	}

	public function getPopular($number)
	{
		return Article::with('tags', 'product', 'author', 'ratings')
			->orderBy('rating', 'desc')->take($number)->get();
	}

	public function getLatest($number)
	{
		return Article::with('tags', 'product', 'author', 'ratings')
			->orderBy('created_at', 'desc')->take($number)->get();
	}

	public function search($term)
	{
		return Article::with('tags', 'product', 'author', 'ratings')
			->where('title', 'like', "%{$term}%")
			->orWhere('summary', 'like', "%{$term}%")
			->orWhere('content', 'like', "%{$term}%")
			->get();
	}

	public function searchAdvanced(array $input)
	{
		$search = ItemModel::query();

		if (array_key_exists('type', $input) and count($input['type']) > 0)
		{
			$search = $search->whereIn('type_id', $input['type']);
		}

		if (array_key_exists('product', $input) and count($input['product']) > 0)
		{
			$search = $search->whereIn('product_id', $input['product']);
		}

		if ( ! empty($input['search']))
		{
			$search = $search->where('name', 'like', "%{$input['search']}%")
				->orWhere('desc', 'like', "%{$input['search']}%");
		}

		return $search->get();
	}

}