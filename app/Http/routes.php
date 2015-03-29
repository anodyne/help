<?php

Route::get('/', [
	'as'	=> 'home',
	'uses'	=> 'MainController@index']);

Route::get('login', [
	'as'	=> 'login',
	'uses'	=> 'Auth\AuthController@getLogin']);
Route::get('logout', [
	'as'	=> 'logout',
	'uses'	=> 'Auth\AuthController@getLogout']);
Route::post('login', 'Auth\AuthController@postLogin');

Route::post('search', [
	'as'	=> 'search.do',
	'uses'	=> '']);

Route::get('admin/article/create', ['as' => 'article.create']);
Route::get('profile/{username}', ['as' => 'account.profile']);
Route::get('admin', ['as' => 'admin']);
