<?php namespace Help\Http\Controllers\Admin;

use ArticleRepositoryInterface;
use Help\Http\Requests;
use Illuminate\Http\Request;
use Help\Http\Controllers\Controller;

class ArticleController extends Controller {

	protected $repo;

	public function __construct(ArticleRepositoryInterface $repo)
	{
		parent::__construct();

		$this->repo = $repo;
	}

	public function index()
	{
		return view('pages.admin.articles.index');
	}

	public function create()
	{
		// Get the products
		$products = app('ProductRepository')->listAll('name', 'id');

		// Get the tags
		$tags = app('TagRepository')->listAll('name', 'id');

		return view('pages.admin.articles.create', compact('products', 'tags'));
	}

	public function store()
	{
		//
	}

	public function edit($id)
	{
		//
	}

	public function update($id)
	{
		//
	}

	public function remove($id)
	{
		//
	}

	public function destroy($id)
	{
		//
	}

	public function confirmRestore($id)
	{
		# code...
	}

	public function restore($id)
	{
		# code...
	}

	public function setSlug()
	{
		# code...
	}

}
