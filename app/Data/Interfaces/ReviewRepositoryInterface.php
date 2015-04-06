<?php namespace Help\Data\Interfaces;

use Review;

interface ReviewRepositoryInterface extends BaseRepositoryInterface {

	public function count();
	public function create(array $data);
	public function delete($id);
	public function getReviewArticle(Review $review);
	public function update($id, array $data);

}
