<?php namespace Help\Http\Controllers\Admin;

use ArticleRepositoryInterface;
use Help\Events,
	Help\Http\Requests,
	Help\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller {

	protected $repo;

	public function __construct(ArticleRepositoryInterface $repo)
	{
		parent::__construct();

		$this->repo = $repo;

		// Before filter to check if the user has permissions
		$this->beforeFilter('@checkPermissions');
	}

	public function notHelpful()
	{
		// Get any article that has unhelpful ratings
		$articles = $this->repo->getLeastHelpfulArticles();

		return view('pages.admin.reports.not-helpful', compact('articles'));
	}

	public function checkPermissions()
	{
		if ( ! $this->currentUser->can('help.admin'))
		{
			return $this->errorUnauthorized("You do not have permission to view reports!");
		}
	}

}
