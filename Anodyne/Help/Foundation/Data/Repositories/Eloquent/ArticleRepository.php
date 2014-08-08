<?php namespace Help\Foundation\Data\Repositories\Eloquent;

use ArticleModel,
	ArticleRepositoryInterface;

class ArticleRepository implements ArticleRepositoryInterface {

	public function getByProduct($product)
	{
		return ArticleModel::with('tags', 'product')
			->product($product)->orderBy('rating', 'desc')->get();
	}

	public function getPopular($number)
	{
		return ArticleModel::with('tags', 'product')
			->orderBy('rating', 'desc')->take($number)->get();
	}

	public function getLatest($number)
	{
		return ArticleModel::with('tags', 'product')
			->orderBy('created_at', 'desc')->take($number)->get();
	}

}
