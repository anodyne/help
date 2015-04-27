<?php namespace Help\Exceptions;

use Log, Auth, Request, Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler {

	/**
	 * A list of the exception types that should not be reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		'Symfony\Component\HttpKernel\Exception\HttpException'
	];

	/**
	 * Report or log an exception.
	 *
	 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
	 *
	 * @param  \Exception  $e
	 * @return void
	 */
	public function report(Exception $e)
	{
		if ($e instanceof NotFoundHttpException)
		{
			Log::notice("404 Not Found");
			Log::notice("URL: ".Request::instance()->fullUrl());
			Log::notice("Referrer: ".@$_SERVER['HTTP_REFERER']);

			if (Auth::check())
				Log::notice("USER: ".Auth::user()->name);
		}
		else
		{
			Log::error("URL: ".Request::instance()->fullUrl());

			if (Auth::check())
				Log::error("USER: ".Auth::user()->name);
		}

		return parent::report($e);
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Exception  $e
	 * @return \Illuminate\Http\Response
	 */
	public function render($request, Exception $e)
	{
		return parent::render($request, $e);
	}

}
