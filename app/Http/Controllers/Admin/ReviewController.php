<?php namespace Help\Http\Controllers\Admin;

use Input, ReviewRepositoryInterface;
use Help\Events,
	Help\Http\Requests,
	Help\Http\Controllers\Controller;

class ReviewController extends Controller {

	protected $repo;

	public function __construct(ReviewRepositoryInterface $repo)
	{
		parent::__construct();

		$this->repo = $repo;
	}

	public function index()
	{
		if ($this->currentUser->can('help.admin'))
		{
			// Get all the reviews
			$reviews = $this->repo->all(['article', 'submitter']);
			
			return view('pages.admin.articles.reviews.index', compact('reviews'));
		}

		return $this->errorUnauthorized("You do not have permission to manage article review requests!");
	}

	public function create()
	{
		//
	}

	public function store()
	{
		//
	}

	public function edit($id)
	{
		if ($this->currentUser->can('help.admin'))
		{
			// Grab the review we're working on
			$review = $this->repo->getById($id);

			// Build the possible statuses
			$statuses = [
				'fixed' => "The issue has been fixed",
				'closed' => "The issue has been closed without any action",
			];

			// Build the body based on whether we found the review or not
			$body = ($review)
				? view('pages.admin.articles.reviews.edit', compact('review', 'statuses'))
				: alert('danger', "Review Request not found.");

			return partial('modal-content', [
				'header' => "Update Review Request",
				'body' => $body,
				'footer' => false,
			]);
		}

		return $this->errorUnauthorized("You do not have permission to update article review requests!");
	}

	public function update($id)
	{
		if ($this->currentUser->can('help.admin'))
		{
			// Update the review
			$review = $this->repo->update($id, Input::all());

			// Fire the event
			event(new Events\ReviewWasUpdated($review));

			// Set the flash message
			flash_success("Article Review Request has been updated.");

			return redirect()->route('admin.review.index');
		}

		return $this->errorUnauthorized("You do not have permission to update article review requests!");
	}

	public function show($id)
	{
		if ($this->currentUser->can('help.admin'))
		{
			// Get the review
			$review = $this->repo->getById($id, ['article', 'submitter']);

			// Get the article
			$article = $this->repo->getReviewArticle($review);

			return view('pages.admin.articles.reviews.show', compact('review', 'article'));
		}

		return $this->errorUnauthorized("You do not have permission to view article review requests!");
	}

}
