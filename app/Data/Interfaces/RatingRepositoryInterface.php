<?php namespace Help\Data\Interfaces;

use User, Article, Rating;

interface RatingRepositoryInterface extends BaseRepositoryInterface {

	public function count(Article $article);
	public function countHelpful(Article $article);
	public function create(Article $article, User $user, $rating);

}
