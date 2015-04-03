<?php namespace Help\Data\Interfaces;

interface ArticleRepositoryInterface extends BaseRepositoryInterface {

	public function allWithTrashed(array $with = []);
	public function getLatestArticles($number = 5);

}
