<?php namespace Help\Data\Interfaces;

use Tag;

interface TagRepositoryInterface extends BaseRepositoryInterface {

	public function allWithTrashed();
	public function create(array $data);
	public function delete($id);
	public function find($id);
	public function getBySlug($slug);
	public function getTagArticles(Tag $tag);
	public function restore($id);
	public function update($id, array $data);

}
