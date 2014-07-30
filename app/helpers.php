<?php

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