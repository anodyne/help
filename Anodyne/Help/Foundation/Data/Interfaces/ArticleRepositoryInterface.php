<?php namespace Help\Foundation\Data\Interfaces;

interface ArticleRepositoryInterface {

	public function getByProduct($product);
	public function getPopular($number);
	public function getLatest($number);

}
