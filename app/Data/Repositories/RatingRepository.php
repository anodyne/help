<?php namespace Help\Data\Repositories;

use User,
	Article,
	Rating as Model,
	RatingRepositoryInterface;

class RatingRepository extends BaseRepository implements RatingRepositoryInterface {

	protected $model;

	public function __construct(Model $model)
	{
		$this->model = $model;
	}

	public function count(Article $article)
	{
		return $article->ratings->count();
	}

	public function countHelpful(Article $article)
	{
		return $article->ratings->filter(function($r)
		{
			return (int) $r->rating === 1;
		})->count();
	}

	public function create(Article $article, User $user, $rating)
	{
		return $this->model->create([
			'article_id'	=> $article->id,
			'user_id'		=> $user->id,
			'rating'		=> $rating,
		]);
	}

}
