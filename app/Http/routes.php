<?php

Route::get('/', ['as' => 'home', 'uses' => 'MainController@index']);

Route::get('login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);
Route::post('login', 'Auth\AuthController@postLogin');

Route::post('search', ['as' => 'search.do', 'uses' => 'MainController@foo']);

Route::get('product/{product}', ['as' => 'product', 'uses' => 'MainController@showProduct']);
Route::get('tag/{tag}', ['as' => 'tag', 'uses' => 'MainController@showTag']);

//Route::get('profile/{username}', ['as' => 'account.profile', 'uses' => 'MainController@foo']);

$adminOptions = [
	'prefix'		=> 'admin',
	'middleware'	=> 'auth',
];

Route::group([$adminOptions], function()
{
	//Route::get('/', ['as' => 'admin', 'uses' => 'MainController@foo']);

	Route::get('admin/product/{id}/remove', 'Admin\ProductController@remove');
	Route::post('admin/product/set-slug', 'Admin\ProductController@setSlug');

	Route::get('admin/tag/{id}/remove', 'Admin\TagController@remove');
	Route::post('admin/tag/set-slug', 'Admin\TagController@setSlug');

	Route::resource('admin/product', 'Admin\ProductController', ['except' => ['show']]);
	Route::resource('admin/tag', 'Admin\TagController', ['except' => ['show']]);
	Route::resource('admin/article', 'Admin\ArticleController', ['except' => ['show']]);
});
