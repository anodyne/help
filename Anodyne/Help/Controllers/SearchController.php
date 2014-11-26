<?php namespace Xtras\Controllers;

use View,
	Input,
	BaseController,
	TagsRepositoryInterface,
	ArticleRepositoryInterface,
	ProductRepositoryInterface;

class SearchController extends BaseController {

	protected $tags;
	protected $articles;
	protected $products;

	public function __construct(ArticleRepositoryInterface $articles,
			ProductRepositoryInterface $products,
			TagRepositoryInterface $tags)
	{
		parent::__construct();

		$this->articles = $articles;
		$this->tags = $tags;
		$this->products = $products;
	}

	public function advanced()
	{
		return View::make('pages.search_advanced')
			->withTypes($this->types->listAll())
			->withProducts($this->products->listAll());
	}

	public function doAdvancedSearch()
	{
		return View::make('pages.search_results')
			->withTerm(Input::get('q'))
			->withResults($this->items->searchAdvanced(Input::all()));
	}

	public function doSearch()
	{
		return View::make('pages.search_results')
			->withTerm(Input::get('q'))
			->withResults($this->items->search(Input::get('q')));
	}

}