<?php

if ( ! function_exists('config'))
{
	function config($key)
	{
		return Config::get($key);
	}
}

if ( ! function_exists('partial'))
{
	function partial($view, $data = false)
	{
		$view = View::make("partials.{$view}");

		if ($data)
		{
			$view->with((array) $data);
		}

		return $view;
	}
}

if ( ! function_exists('modal'))
{
	function modal(array $data = array())
	{
		return View::make('partials.modal')
			->with('modalId', (array_key_exists('id', $data)) ? $data['id'] : false)
			->with('modalHeader', (array_key_exists('header', $data)) ? $data['header'] : false)
			->with('modalBody', (array_key_exists('body', $data)) ? $data['body'] : false)
			->with('modalFooter', (array_key_exists('footer', $data)) ? $data['footer'] : false);
	}
}

if ( ! function_exists('alert'))
{
	function alert($level, $message)
	{
		return View::make('partials.alert')
			->withType($level)
			->withContent($message);
	}
}

if ( ! function_exists('flash'))
{
	function flash($level, $message)
	{
		return alert($level, $message);
	}
}

if ( ! function_exists('label'))
{
	function label($level, $message)
	{
		return View::make('partials.label')
			->withClass($level)
			->withContent($message);
	}
}