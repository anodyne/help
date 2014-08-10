<?php namespace Help\Controllers;

use View,
	Input,
	Session,
	Redirect,
	TagRepositoryInterface,
	ArticleRepositoryInterface,
	ProductRepositoryInterface;

class SearchController extends BaseController {

	protected $tags;
	protected $articles;
	protected $products;

	public function __construct(ArticleRepositoryInterface $articles,
			TagRepositoryInterface $tags, ProductRepositoryInterface $products)
	{
		parent::__construct();

		$this->tags = $tags;
		$this->articles = $articles;
		$this->products = $products;
	}

	public function advanced()
	{
		return View::make('pages.search_advanced')
			->withProducts($this->products->all('name', 'id'))
			->withTags($this->tags->all('name', 'id'));
	}

	public function doAdvancedSearch()
	{
		return Redirect::route('search.results')
			->withTerm(Input::get('search'))
			->withResults($this->articles->searchAdvanced(Input::all()));
	}

	public function doSearch()
	{
		return View::make('pages.search_results')
			->withTerm(Input::get('search'))
			->withResults($this->articles->search(Input::get('search')));
	}

	public function results()
	{
		return View::make('pages.search_results')
			->withTerm(Session::get('term'))
			->withResults(Session::get('results'));
	}

}