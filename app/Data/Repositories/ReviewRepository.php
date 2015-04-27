<?php namespace Help\Data\Repositories;

use Review as Model,
	ReviewRepositoryInterface;

class ReviewRepository extends BaseRepository implements ReviewRepositoryInterface {

	protected $model;

	public function __construct(Model $model)
	{
		$this->model = $model;
	}

	public function all(array $with = [])
	{
		$query = $this->make($with)->open();

		return $query->orderBy('created_at', 'asc')->get();
	}

	public function count()
	{
		return $this->model->open()->count();
	}

	public function create(array $data)
	{
		return $this->model->create($data);
	}

	public function delete($id)
	{
		// Get the review
		$review = $this->find($id);

		if ($review)
		{
			// Remove the review
			$review->delete();

			return true;
		}

		return false;
	}

	public function getReviewArticle(Model $review)
	{
		return $review->article;
	}

	public function update($id, array $data)
	{
		// Get the review
		$review = $this->getById($id);

		if ($review)
		{
			// Fill the data
			$updatedItem = $review->fill($data);

			// Save the review
			$review->save();

			return $updatedItem;
		}

		return false;
	}

}
