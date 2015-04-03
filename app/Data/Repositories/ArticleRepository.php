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

	public function getLatestArticles($number = 5)
	{
		return $this->model->with(['tags', 'product', 'author'])
			->latest()->limit($number)->get();
	}

}
