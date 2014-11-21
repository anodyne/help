<?php namespace Help\Controllers;

use View,
	Event,
	Flash,
	Input,
	Redirect,
	Paginator,
	ArticleRepositoryInterface;

class ArticleController extends BaseController {

	protected $articles;

	public function __construct(ArticleRepositoryInterface $articles)
	{
		$this->articles = $articles;
	}

	public function index()
	{
		//
	}

	public function create()
	{
		//
	}

	public function store()
	{
		//
	}

	public function show($product, $slug)
	{
		// Get the article
		$article = $this->articles->findByProductAndSlug($product, $slug);

		if ($article->count() > 1)
		{
			//
		}

		return View::make('pages.article.show')->withArticle($article->first());
	}

	public function edit($id)
	{
		//
	}

	public function update($id)
	{
		//
	}

	public function destroy($id)
	{
		//
	}

	public function product($product)
	{
		// Clean up the product name
		$productName = $this->parseProductName($product);

		// Grab the articles
		$articles = $this->articles->getByProduct($product);

		// Build the paginator
		$paginator = Paginator::make($articles->toArray(), $articles->count(), 25);

		return View::make('pages.article.product')
			->withArticles($articles)
			->withCount($articles->count())
			->withProduct($productName);
	}

	protected function parseProductName($product)
	{
		return str_replace('+', ' ', $product);
	}

}
