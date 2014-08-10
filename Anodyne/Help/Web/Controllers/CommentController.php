<?php namespace Help\Controllers;

use Input,
	CommentTransformer,
	ArticleRepositoryInterface;

class CommentController extends BaseController {

	protected $articles;

	public function __construct(ArticleRepositoryInterface $articles)
	{
		parent::__construct();
		
		$this->articles = $articles;
	}

	public function index($articleId)
	{
		return $this->respondWithCollection($this->articles->getComments($articleId), new CommentTransformer);
	}

	public function store($articleId)
	{
		return $this->articles->addComment($articleId, Input::all());
	}

}