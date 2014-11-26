<?php namespace Help\Controllers;

use Auth,
	View,
	Event,
	Input,
	Session,
	Redirect,
	Validator,
	TagRepositoryInterface,
	ArticleRepositoryInterface,
	ProductRepositoryInterface;

class MainController extends BaseController {

	protected $tags;
	protected $articles;
	protected $products;

	public function __construct(ArticleRepositoryInterface $articles,
			ProductRepositoryInterface $products,
			TagRepositoryInterface $tags)
	{
		parent::__construct();

		$this->tags = $tags;
		$this->articles = $articles;
		$this->products = $products;
	}

	public function index()
	{
		return View::make('pages.main')
			->withLatest($this->articles->getLatest(10))
			->withHelpful($this->articles->getPopular(10));
	}

	public function product($product)
	{
		$articles = $this->articles->getByProduct($product);

		return View::make('pages.product')
			->withProduct($this->products->getFirstBy('slug', $product))
			->withArticles($articles)
			->withCount($articles->count());
	}

	public function tag($tag)
	{
		$articles = $this->articles->getByTag($tag);

		return View::make('pages.tag')
			->withTag($this->tags->getFirstBy('slug', $tag))
			->withArticles($articles)
			->withCount($articles->count());
	}

}
