<?php namespace Help\Data\Interfaces;

interface ArticleRepositoryInterface extends BaseRepositoryInterface {

	public function allWithTrashed(array $with = []);
	public function checkForDuplicateSlugs($product, $slug);
	public function create(array $data);
	public function delete($id);
	public function find($id);
	public function getByProductAndSlug($product, $slug);
	public function getLatestArticles($number = 5);
	public function getMostHelpfulArticles($number = 5);
	public function restore($id);
	public function search($input);
	public function searchAdvanced(array $input);
	public function update($id, array $data);

}
