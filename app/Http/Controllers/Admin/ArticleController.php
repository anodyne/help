<?php namespace Help\Http\Controllers\Admin;

use Str, Input, ArticleRepositoryInterface;
use Help\Events,
	Help\Http\Requests,
	Help\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

	public function store(Requests\CreateArticleRequest $request)
	{
		// Build the input array
		$input = array_merge(Input::all(), ['user_id' => $this->currentUser->id]);

		// Store the article
		$article = $this->repo->create($input);

		// Fire the event
		event(new Events\ArticleWasCreated($article));

		// Set the flash message
		flash_success("Article was created.");

		return redirect()->route('admin.article.index');
	}

	public function edit($id)
	{
		// Get the products
		$products = app('ProductRepository')->listAll('name', 'id');

		// Get the tags
		$tags = app('TagRepository')->listAll('name', 'id');

		// Get the article
		$article = $this->repo->find($id);

		// Get the article's tags
		foreach ($article->tags as $tag)
		{
			$articleTags[] = (int) $tag->id;
		}

		return view('pages.admin.articles.edit',
			compact('products', 'tags', 'article', 'articleTags'));
	}

	public function update(Requests\EditArticleRequest $request, $id)
	{
		// Build the input array
		$input = Input::all();

		// Grab the tags
		$tags = $input['tag'];

		// Clear the bad field
		unset($input['tag']);

		// Put the new one in
		$input['tags'] = $tags;

		// Update the article
		$article = $this->repo->update($id, $input);

		// Fire the event
		event(new Events\ArticleWasUpdated($article));

		// Set the flash message
		flash_success("Article was updated.");

		return redirect()->route('admin.article.index');
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
		// Build the slug
		$slug = ( ! Str::contains(Input::get('value'), '-'))
			? Str::slug(Input::get('value'))
			: Input::get('value');

		// Do we have duplicates of this slug?
		$duplicate = $this->repo->checkForDuplicateSlugs(Input::get('product'), $slug);

		if ($duplicate)
		{
			return json_encode(['code' => 0, 'slug' => ""]);
		}

		return json_encode(['code' => 1, 'slug' => $slug]);
	}

}
