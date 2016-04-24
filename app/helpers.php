<?php

use Illuminate\Support\Debug\Dumper;

if ( ! function_exists('alert'))
{
	function alert($level, $content, $header = false)
	{
		$content = Markdown::parse($content);

		return partial('alert', compact('level', 'content', 'header'));
	}
}

if ( ! function_exists('d'))
{
	function d()
	{
		array_map(function($x) { (new Dumper)->dump($x); }, func_get_args());
	}
}

if ( ! function_exists('flash'))
{
	function flash($level = false, $content = false, $header = false)
	{
		$level = ( ! Session::has('flash.level')) ? $level : Session::get('flash.level');
		$content = ( ! Session::has('flash.message')) ? $content : Session::get('flash.message');
		$header = ( ! Session::has('flash.header')) ? $header : Session::get('flash.header');

		return partial('flash', compact('level', 'content', 'header'));
	}
}

if ( ! function_exists('flash_error'))
{
	function flash_error($message, $header = false)
	{
		return Flash::error($message, $header);
	}
}

if ( ! function_exists('flash_success'))
{
	function flash_success($message, $header = false)
	{
		return Flash::success($message, $header);
	}
}

if ( ! function_exists('icon'))
{
	function icon($icon, $size = 'sm', $additional = false)
	{
		return partial('icon', compact('icon', 'size', 'additional'));
	}
}

if ( ! function_exists('label'))
{
	function label($class, $content)
	{
		return partial('label', compact('class', 'content'));
	}
}

if ( ! function_exists('modal'))
{
	function modal(array $data)
	{
		return partial('modal', [
			'id'		=> (array_key_exists('id', $data)) ? $data['id'] : false,
			'header'	=> (array_key_exists('header', $data)) ? $data['header'] : false,
			'body'		=> (array_key_exists('body', $data)) ? $data['body'] : false,
			'footer'	=> (array_key_exists('footer', $data)) ? $data['footer'] : false,
		]);
	}
}

if ( ! function_exists('partial'))
{
	function partial($file, array $data = [])
	{
		return view("partials.{$file}", $data)->render();
	}
}
