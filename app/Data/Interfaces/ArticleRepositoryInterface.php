<?php namespace Help\Data\Interfaces;

interface ArticleRepositoryInterface extends BaseRepositoryInterface {

	public function getLatestArticles($number = 5);

}
