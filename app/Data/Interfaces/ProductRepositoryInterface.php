<?php namespace Help\Data\Interfaces;

use Product;

interface ProductRepositoryInterface extends BaseRepositoryInterface {

	public function allWithTrashed();
	public function create(array $data);
	public function delete($id);
	public function find($id);
	public function getBySlug($slug);
	public function getProductArticles(Product $product);
	public function getProductFeaturedArticles(Product $product);
	public function restore($id);
	public function update($id, array $data);

}
