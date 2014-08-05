<?php namespace Help\Foundation\Data\Repositories\Eloquent;

use ArticleModel,
	ArticleRepositoryInterface;

class ArticleRepository implements ArticleRepositoryInterface {

	public function getPopularArticles($number)
	{
		return ArticleModel::orderBy('rating', 'desc')->take($number)->get();
	}

	public function getLatestArticles($number)
	{
		return ArticleModel::orderBy('created_at', 'desc')->take($number)->get();
	}

}