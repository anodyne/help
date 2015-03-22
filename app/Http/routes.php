<?php

Route::get('/', [
	'as'	=> 'home',
	'uses'	=> 'MainController@index']);

Route::get('login', [
	'as'	=> 'login',
	'uses'	=> '']);

Route::post('login', [
	'as'	=> 'search.do',
	'uses'	=> '']);
