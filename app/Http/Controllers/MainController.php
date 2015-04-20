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

	public function index(ProductRepositoryInterface $productRepo, TagRepositoryInterface $tagRepo)
	{
		// Get the products
		$products = $productRepo->all();

		// Get the tags
		$tags = $tagRepo->all();

		// Get the newest articles
		$newest = $this->repo->getLatestArticles(6);

		// Get the helpful articles
		$helpful = $this->repo->getMostHelpfulArticles(6);

		return view('pages.main', compact('products', 'tags', 'newest', 'helpful'));
	}

	public function showProduct(ProductRepositoryInterface $productRepo, $product)
	{
		// Get the product
		$product = $productRepo->getBySlug($product);

		// Get the product's newest articles
		$newest = $productRepo->getProductNewestArticles($product);

		// Get the product's most helpful articles
		$helpful = $productRepo->getProductHelpfulArticles($product);

		// Get the product's featured articles
		$featured = $productRepo->getProductFeaturedArticles($product);

		return view('pages.product', compact('newest', 'product', 'helpful', 'featured'));
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
