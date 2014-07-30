<?php namespace Help\Controllers;

use View;

class MainController extends BaseController {

	public function index()
	{
		return View::make('pages.home');
	}

}