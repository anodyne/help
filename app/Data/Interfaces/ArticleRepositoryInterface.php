<?php namespace Help\Data\Interfaces;

interface ArticleRepositoryInterface extends BaseRepositoryInterface {

	public function allWithTrashed(array $with = []);
	public function checkForDuplicateSlugs($product, $slug);
	public function create(array $data);
	public function find($id);
	public function getLatestArticles($number = 5);
	public function update($id, array $data);

}
