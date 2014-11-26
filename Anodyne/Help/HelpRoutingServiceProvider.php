<?php namespace Help;

use Route;
use Illuminate\Support\ServiceProvider;

class HelpRoutingServiceProvider extends ServiceProvider {

	public function register() {}

	public function boot()
	{
		$this->routeProtections();

		$this->sessionsRoutes();
		$this->pagesRoutes();
		$this->searchRoutes();
		$this->accountRoutes();
		//$this->miscRoutes();
		$this->adminRoutes();
		$this->articleRoutes();
	}

	protected function routeProtections()
	{
		// Make sure CSRF protection is in place
		Route::when('*', 'csrf', ['post', 'put', 'patch']);
	}

	protected function sessionsRoutes()
	{
		Route::get('login', [
			'as'	=> 'login',
			'uses'	=> 'Help\Controllers\LoginController@index']);
		Route::post('login', [
			'as'	=> 'login.do',
			'uses'	=> 'Help\Controllers\LoginController@doLogin']);
		Route::get('logout', [
			'before'	=> 'auth',
			'as'		=> 'logout',
			'uses'		=> 'Help\Controllers\LoginController@logout']);
	}

	protected function pagesRoutes()
	{
		Route::group(['namespace' => 'Help\Controllers'], function()
		{
			Route::get('/', [
				'as'	=> 'home',
				'uses'	=> 'MainController@index']);

			Route::get('product/{product}', [
				'as'	=> 'product',
				'uses'	=> 'MainController@product']);

			Route::get('tag/{tag}', [
				'as'	=> 'tag',
				'uses'	=> 'MainController@tag']);
		});
	}

	protected function searchRoutes()
	{
		$groupOptions = [
			'prefix'	=> 'search',
			'namespace' => 'Help\Controllers'
		];

		Route::group($groupOptions, function()
		{
			Route::get('/', [
				'as'	=> 'search.do',
				'uses'	=> 'SearchController@doSearch']);
			Route::get('advanced', [
				'as'	=> 'search.advanced',
				'uses'	=> 'SearchController@advanced']);
			Route::get('advanced-results', [
				'as'	=> 'search.doAdvanced',
				'uses'	=> 'SearchController@doAdvancedSearch']);
		});
	}

	protected function articleRoutes()
	{
		$groupOptions = [
			'namespace' => 'Help\Controllers'
		];

		Route::group($groupOptions, function()
		{
			Route::resource('article', 'ArticleController');

			Route::get('article/{product}/{slug}', [
				'as'	=> 'article.show',
				'uses'	=> 'ArticleController@show']);
		});
	}

	protected function accountRoutes()
	{
		Route::group(['namespace' => 'Help\Controllers'], function()
		{
			Route::get('profile/{username}', [
				'as'	=> 'account.profile',
				'uses'	=> 'UserController@show']);
			Route::get('my-articles', [
				'before'	=> 'auth',
				'as'		=> 'account.xtras',
				'uses'		=> 'UserController@articles']);
			Route::get('notifications', [
				'before'	=> 'auth',
				'as'		=> 'account.notifications',
				'uses'		=> 'UserController@notifications']);
			Route::post('notifications/add', [
				'before'	=> 'auth',
				'as'		=> 'account.notifications.add',
				'uses'		=> 'UserController@addNotification']);
			Route::post('notifications/remove', [
				'before'	=> 'auth',
				'as'		=> 'account.notifications.remove',
				'uses'		=> 'UserController@removeNotification']);
		});
	}

	protected function adminRoutes()
	{
		$groupOptions = [
			'before'	=> 'auth',
			'prefix'	=> 'admin',
			'namespace' => 'Help\Controllers\Admin'
		];

		Route::group($groupOptions, function()
		{
			Route::resource('products', 'ProductsController', ['except' => ['show']]);
			//Route::resource('types', 'TypesController', ['except' => ['show']]);

			Route::get('products/{id}/remove', 'ProductsController@remove');
			//Route::get('types/{id}/remove', 'TypesController@remove');
		});
	}

}
