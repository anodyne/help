<?php namespace Help\Http\Api;

use ArticleRepositoryInterface;
use League\Fractal\Manager;
use Help\Data\Transformers\ArticleTransformer;

class ArticleController extends ApiController {

	protected $repo;

	public function __construct(Manager $fractal, ArticleRepositoryInterface $repo)
	{
		parent::__construct($fractal);

		$this->repo = $repo;
	}

	public function index()
	{
		return $this->respondWithCollection(
			$this->repo->all(['product', 'author', 'tags']),
			new ArticleTransformer
		);
	}

	public function trashed()
	{
		return $this->respondWithCollection(
			$this->repo->allWithTrashed(['product', 'author', 'tags']),
			new ArticleTransformer
		);
	}

}
