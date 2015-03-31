<?php namespace Help\Data\Interfaces;

use Product;

interface ProductRepositoryInterface extends BaseRepositoryInterface {

	public function create(array $data);
	public function delete($id);
	public function getBySlug($slug);
	public function getProductArticles(Product $product);
	public function update($id, array $data);

}
