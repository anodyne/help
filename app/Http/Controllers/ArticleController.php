<?php namespace Help\Http\Controllers;

use Input,
	RatingRepositoryInterface,
	ArticleRepositoryInterface;
use Help\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleController extends Controller {

	protected $repo;
	protected $ratingRepo;

	public function __construct(ArticleRepositoryInterface $repo,
			RatingRepositoryInterface $ratingRepo)
	{
		parent::__construct();

		$this->repo = $repo;
		$this->ratingRepo = $ratingRepo;
	}

	public function show($product, $slug)
	{
		// Get the article
		$article = $this->repo->getByProductAndSlug($product, $slug);

		if ($article)
		{
			// Get the ratings
			$rating = $this->ratingRepo->countHelpful($article);

			return view('pages.article', compact('article', 'rating'));
		}
	}

	public function rate()
	{
		// Get the article
		$article = $this->repo->getById(Input::get('article'));

		// Rate the article
		$this->ratingRepo->create($article, $this->currentUser, Input::get('rating'));
	}

}
