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
		if ( ! $this->currentUser->can('help.admin'))
		{
			return $this->errorUnauthorized("You do not have permission to manage products!");
		}

		// Get all the products
		$products = $this->repo->allWithTrashed();

		return view('pages.admin.products.index', compact('products'));
	}

	public function create()
	{
		if ( ! $this->currentUser->can('help.admin'))
		{
			return $this->errorUnauthorized("You do not have permission to manage products!");
		}

		return view('pages.admin.products.create');
	}

	public function store(Requests\CreateProductRequest $request)
	{
		if ( ! $this->currentUser->can('help.admin'))
		{
			return $this->errorUnauthorized("You do not have permission to manage products!");
		}

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
		if ( ! $this->currentUser->can('help.admin'))
		{
			return $this->errorUnauthorized("You do not have permission to manage products!");
		}

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
		if ( ! $this->currentUser->can('help.admin'))
		{
			return $this->errorUnauthorized("You do not have permission to manage products!");
		}

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
		if ( ! $this->currentUser->can('help.admin'))
		{
			return $this->errorUnauthorized("You do not have permission to manage products!");
		}

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

	public function confirmRestore($id)
	{
		// Grab the product we're restoring
		$product = $this->repo->find($id);

		// Build the body based on whether we found the product or not
		$body = ($product)
			? view('pages.admin.products.restore', compact('product'))
			: alert('danger', "Product not found.");

		return partial('modal-content', [
			'header' => "Restore Product",
			'body' => $body,
			'footer' => false,
		]);
	}

	public function restore($id)
	{
		if ( ! $this->currentUser->can('help.admin'))
		{
			return $this->errorUnauthorized("You do not have permission to manage products!");
		}

		// Restore the product
		$product = $this->repo->restore($id);

		// Fire the event
		event(new Events\ProductWasUpdated($product));

		// Set the flash message
		flash_success("Product was restored.");

		return redirect()->route('admin.product.index');
	}

}
