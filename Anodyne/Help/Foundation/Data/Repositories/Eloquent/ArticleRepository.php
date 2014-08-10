<?php namespace Help\Foundation\Data\Repositories\Eloquent;

use ArticleModel,
	CommentModel,
	ArticleRepositoryInterface;

class ArticleRepository implements ArticleRepositoryInterface {

	public function findByProductAndSlug($product, $slug)
	{
		return ArticleModel::with('tags', 'product', 'author', 'ratings', 'comments', 'comments.author')
			->product($product)->slug($slug)->get();
	}

	public function getByProduct($product)
	{
		return ArticleModel::with('tags', 'product', 'author', 'ratings')
			->product($product)->orderBy('rating', 'desc')->get();
	}

	public function getComments($id)
	{
		return CommentModel::with('author')->article($id)->get();
	}

	public function getPopular($number)
	{
		return ArticleModel::with('tags', 'product', 'author', 'ratings')
			->orderBy('rating', 'desc')->take($number)->get();
	}

	public function getLatest($number)
	{
		return ArticleModel::with('tags', 'product', 'author', 'ratings')
			->orderBy('created_at', 'desc')->take($number)->get();
	}

}
