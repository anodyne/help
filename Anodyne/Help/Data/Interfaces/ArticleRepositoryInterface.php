<?php namespace Help\Data\Interfaces;

interface ArticleRepositoryInterface extends BaseRepositoryInterface {

	public function findByProductAndSlug($product, $slug);
	public function getByProduct($product);
	public function getComments($id);
	public function getPopular($number);
	public function getLatest($number);
	public function getByTag($tag);
	public function search($input);
	public function searchAdvanced(array $input);

}