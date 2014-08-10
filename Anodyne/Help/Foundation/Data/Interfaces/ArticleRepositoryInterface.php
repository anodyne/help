<?php namespace Help\Foundation\Data\Interfaces;

interface ArticleRepositoryInterface {

	public function findByProductAndSlug($product, $slug);
	public function getByProduct($product);
	public function getComments($id);
	public function getPopular($number);
	public function getLatest($number);
	public function search($term);
	public function searchAdvanced(array $terms);

}