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

		// Before filter to check if the user has permissions
		$this->beforeFilter('@checkPermissions');
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
		// Grab the article we're removing
		$article = $this->repo->getById($id);

		// Build the body based on whether we found the article or not
		$body = ($article)
			? view('pages.admin.articles.remove', compact('article'))
			: alert('danger', "Article not found.");

		return partial('modal-content', [
			'header' => "Remove Article",
			'body' => $body,
			'footer' => false,
		]);
	}

	public function destroy($id)
	{
		// Remove the article
		$article = $this->repo->delete($id);

		// Fire the event
		event(new Events\ArticleWasDeleted($article->id, $article->title));

		// Set the flash message
		flash_success("Article was removed.");

		return redirect()->route('admin.article.index');
	}

	public function confirmRestore($id)
	{
		// Grab the article we're restoring
		$article = $this->repo->find($id);

		// Build the body based on whether we found the article or not
		$body = ($article)
			? view('pages.admin.articles.restore', compact('article'))
			: alert('danger', "Article not found.");

		return partial('modal-content', [
			'header' => "Restore Article",
			'body' => $body,
			'footer' => false,
		]);
	}

	public function restore($id)
	{
		// Restore the article
		$article = $this->repo->restore($id);

		// Fire the event
		event(new Events\ArticleWasUpdated($article));

		// Set the flash message
		flash_success("Article was restored.");

		return redirect()->route('admin.article.index');
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

	public function checkPermissions()
	{
		if ( ! $this->currentUser->can('help.admin'))
		{
			return $this->errorUnauthorized("You do not have permission to manage articles!");
		}
	}

}
