<?php namespace Help\Controllers;

use Log,
	Auth,
	View,
	Request,
	Response,
	Controller;
use League\Fractal\Manager,
	League\Fractal\Resource\Collection,
	League\Fractal\Serializer\DataArraySerializer;

abstract class BaseController extends Controller {

	protected $currentUser;
	protected $layout = 'layouts.master';
	protected $request;
	protected $fractal;

	public function __construct()
	{
		$this->currentUser	= Auth::user();
		$this->request		= Request::instance();
		$this->fractal		= new Manager;

		$this->fractal->setSerializer(new DataArraySerializer);
	}

	protected function errorUnauthorized($message = false)
	{
		Log::error("{$this->currentUser->name} attempted to access {$this->request->fullUrl()}");

		if ($message)
		{
			return View::make('pages.error')->withError($message)->withType('danger');
		}
	}

	protected function errorNotFound($message = false)
	{
		Log::error("{$this->currentUser->name} attempted to reach {$this->request->fullUrl()}");

		if ($message)
		{
			return View::make('pages.error')->withError($message)->withType('warning');
		}
	}

	protected function respondWithCollection($collection, $callback)
	{
		$resource = new Collection($collection, $callback);

		$rootScope = $this->fractal->createData($resource);

		return $this->respondWithArray($rootScope->toArray());
	}

	protected function respondWithArray(array $data, array $headers = [])
	{
		return Response::json($data, 200, $headers);
	}

}