<?php namespace Help\Http\Controllers\Admin;

use Str,
	Input,
	ProductRepositoryInterface;
use Help\Events,
	Help\Http\Requests,
	Help\Http\Controllers\Controller;

class ProductController extends Controller {

	protected $repo;

	public function __construct(ProductRepositoryInterface $repo)
	{
		parent::__construct();

		$this->repo = $repo;
	}

	public function index()
	{
		// Get all the products
		$products = $this->repo->all();

		return view('pages.admin.products.index', compact('products'));
	}

	public function create()
	{
		return view('pages.admin.products.create');
	}

	public function store(Requests\CreateProductRequest $request)
	{
		// Create the product
		$product = $this->repo->create(Input::all());

		// Fire the event
		event(new Events\ProductWasCreated($product));

		// Set the flash message
		flash_success("Product was created.");

		return redirect()->route('admin.product.index');
	}

	public function edit($id)
	{
		// Get the product
		$product = $this->repo->getById($id);

		if ($product)
		{
			return view('pages.admin.products.edit', compact('product'));
		}

		return $this->errorNotFound("We couldn't find the product you're looking for.");
	}

	public function update(Requests\EditProductRequest $request, $id)
	{
		// Update the product
		$product = $this->repo->update($id, Input::all());

		// Fire the event
		event(new Events\ProductWasUpdated($product));

		// Set the flash message
		flash_success("Product was updated.");

		return redirect()->route('admin.product.index');
	}

	public function remove($id)
	{
		// Grab the product we're removing
		$product = $this->repo->getById($id);

		// Build the body based on whether we found the product or not
		$body = ($product)
			? view('pages.admin.products.remove', compact('product'))
			: alert('danger', "Product not found.");

		return partial('modal-content', [
			'header' => "Remove Product",
			'body' => $body,
			'footer' => false,
		]);
	}

	public function destroy($id)
	{
		// Remove the product
		$this->repo->delete($id);

		// Set the flash message
		flash_success("Product was removed.");

		return redirect()->route('admin.product.index');
	}

	public function setSlug()
	{
		return json_encode(['slug' => Str::slug(Input::get('value'))]);
	}

}
