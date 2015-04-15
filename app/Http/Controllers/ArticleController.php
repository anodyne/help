<?php namespace Help\Http\Controllers;

use Input,
	RatingRepositoryInterface,
	ReviewRepositoryInterface,
	ArticleRepositoryInterface;
use Help\Commands;
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

		return abort(404);
	}

	public function rate()
	{
		// Get the article
		$article = $this->repo->getById(Input::get('article'));

		if (Input::get('rating') == "reset")
		{
			// Remove the rating
			$this->ratingRepo->delete($article, $this->currentUser);
		}
		else
		{
			// Rate the article
			$this->ratingRepo->create($article, $this->currentUser, Input::get('rating'));
		}

		return json_encode(['code' => 1]);
	}

	public function review(ReviewRepositoryInterface $reviewRepo)
	{
		// Create the review request
		$reviewRepo->create([
			'article_id'	=> Input::get('article'),
			'user_id'		=> $this->currentUser->id,
			'type'			=> Input::get('type'),
			'comments'		=> Input::get('comments'),
		]);

		// Set the flash message
		flash_success("Thank you for submitting an article review request. We'll look over the article and make any necessary corrections.");

		return redirect()->back();
	}

	public function share(Request $request)
	{
		if (empty($request->get('recipients')))
		{
			// Set the flash message
			flash_error("You must add recipients to share this article.");

			return redirect()->back();
		}

		// Dispatch the share command
		$this->dispatch(new Commands\ShareArticleCommand(
			$request->get('recipients'),
			$request->get('message'),
			$this->currentUser
		));

		// Set the flash message
		flash_success("Article has been sent.");

		return redirect()->back();
	}

}
