<?php namespace Help\Foundation\Data\Interfaces;

interface ArticleRepositoryInterface {

	public function getPopularArticles($number);
	public function getLatestArticles($number);

}