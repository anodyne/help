<?php namespace Help\Http\Controllers;

use TagRepositoryInterface,
	ArticleRepositoryInterface,
	ProductRepositoryInterface;
use Help\Http\Requests,
	Help\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller {

	protected $repo;

	public function __construct(ArticleRepositoryInterface $repo)
	{
		parent::__construct();
		
		$this->repo = $repo;
	}

	public function index()
	{
		$latest = $this->repo->getLatestArticles();
		$helpful = [];

		return view('pages.main', compact('latest', 'helpful'));
	}

	public function showProduct(ProductRepositoryInterface $productRepo, $product)
	{
		// Get the product
		$product = $productRepo->getBySlug($product);

		// Get the product's articles
		$articles = $productRepo->getProductArticles($product);

		return view('pages.product', compact('articles', 'product'));
	}

	public function showTag(TagRepositoryInterface $tagRepo, $tag)
	{
		// Get the tag
		$tag = $tagRepo->getBySlug($tag);

		// Get the tag's articles
		$articles = $tagRepo->getTagArticles($tag);

		return view('pages.tag', compact('articles', 'tag'));
	}

}