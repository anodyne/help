<?php

Route::get('/', [
	'as'	=> 'home',
	'uses'	=> 'MainController@index']);

Route::get('login', [
	'as'	=> 'login',
	'uses'	=> 'LoginController@index']);
Route::get('logout', [
	'as'	=> 'logout',
	'uses'	=> 'LoginController@logout']);
Route::post('login', 'LoginController@doLogin');

Route::get('advanced-search', [
	'as'	=> 'search.advanced',
	'uses'	=> 'SearchController@advanced']);
Route::get('search', [
	'as'	=> 'search.do',
	'uses'	=> 'SearchController@doSearch']);
Route::get('advanced-results', [
	'as'	=> 'search.doAdvanced',
	'uses'	=> 'SearchController@doAdvancedSearch']);

Route::get('product/{product}', [
	'as'	=> 'product',
	'uses'	=> 'MainController@showProduct']);
Route::get('tag/{tag}', [
	'as'	=> 'tag',
	'uses'	=> 'MainController@showTag']);

Route::get('article/{product}/{slug}', [
	'as'	=> 'article.show',
	'uses'	=> 'ArticleController@show']);
Route::post('article/rate', [
	'as'		=> 'article.rate',
	'uses'		=> 'ArticleController@rate',
	'middleware'=> 'auth']);
Route::post('article/share', [
	'as'		=> 'article.share',
	'uses'		=> 'ArticleController@share',
	'middleware'=> 'auth']);
Route::post('article/review', [
	'as'		=> 'article.review',
	'uses'		=> 'ArticleController@review',
	'middleware'=> 'auth']);

$adminOptions = [
	'prefix'		=> 'admin',
	'middleware'	=> 'auth',
];

Route::group($adminOptions, function()
{
	Route::get('product/{id}/remove', 'Admin\ProductController@remove');
	Route::post('product/set-slug', 'Admin\ProductController@setSlug');
	Route::get('product/{id}/restore', 'Admin\ProductController@confirmRestore');
	Route::put('product/{id}/restore', [
		'as'	=> 'admin.product.restore',
		'uses'	=> 'Admin\ProductController@restore']);

	Route::get('tag/{id}/remove', 'Admin\TagController@remove');
	Route::post('tag/set-slug', 'Admin\TagController@setSlug');
	Route::get('tag/{id}/restore', 'Admin\TagController@confirmRestore');
	Route::put('tag/{id}/restore', [
		'as'	=> 'admin.tag.restore',
		'uses'	=> 'Admin\TagController@restore']);

	Route::get('article/{id}/remove', 'Admin\ArticleController@remove');
	Route::post('article/set-slug', 'Admin\ArticleController@setSlug');
	Route::get('article/{id}/restore', 'Admin\ArticleController@confirmRestore');
	Route::put('article/{id}/restore', [
		'as'	=> 'admin.article.restore',
		'uses'	=> 'Admin\ArticleController@restore']);

	Route::resource('product', 'Admin\ProductController', ['except' => ['show']]);
	Route::resource('tag', 'Admin\TagController', ['except' => ['show']]);
	Route::resource('article', 'Admin\ArticleController', ['except' => ['show']]);
	Route::resource('review', 'Admin\ReviewController', ['except' => ['destroy']]);

	Route::get('report/least-helpful', [
		'as'	=> 'admin.report.least-helpful',
		'uses'	=> 'Admin\ReportController@leastHelpful']);
});
