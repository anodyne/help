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
		$this->miscRoutes();
		$this->adminRoutes();
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
			'uses'	=> 'Help\Controllers\MainController@login']);
		Route::post('login', [
			'as'	=> 'login.do',
			'uses'	=> 'Help\Controllers\MainController@doLogin']);
		Route::get('logout', [
			'as'	=> 'logout',
			'uses'	=> 'Help\Controllers\MainController@logout']);
		
		Route::get('register', [
			'as'	=> 'register',
			'uses'	=> 'Help\Controllers\MainController@register']);
		Route::post('register', [
			'as'	=> 'register.do',
			'uses'	=> 'Help\Controllers\MainController@doRegistration']);

		Route::group(['prefix' => 'password', 'namespace' => 'Help\Controllers'], function()
		{
			Route::get('remind', [
				'as'	=> 'password.remind',
				'uses'	=> 'RemindersController@remind']);
			Route::post('remind', [
				'as'	=> 'password.remind.do',
				'uses'	=> 'RemindersController@doRemind']);
			Route::get('reset/{token}', [
				'as'	=> 'password.reset',
				'uses'	=> 'RemindersController@reset']);
			Route::post('reset', [
				'as'	=> 'password.reset.do',
				'uses'	=> 'RemindersController@doReset']);
		});
	}

	protected function pagesRoutes()
	{
		Route::group(['namespace' => 'Help\Controllers'], function()
		{
			Route::get('/', [
				'as'		=> 'home',
				'uses'		=> 'MainController@index']);
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
			Route::post('/', [
				'as'	=> 'search.do',
				'uses'	=> 'SearchController@doSearch']);
			Route::get('results', [
				'as'	=> 'search.results',
				'uses'	=> 'SearchController@results']);
			Route::get('advanced', [
				'as'	=> 'search.advanced',
				'uses'	=> 'SearchController@advanced']);
			Route::post('advanced', [
				'as'	=> 'search.doAdvanced',
				'uses'	=> 'SearchController@doAdvancedSearch']);
		});
	}

	protected function accountRoutes()
	{
		Route::group(['before' => 'auth', 'namespace' => 'Xtras\Controllers'], function()
		{
			Route::get('profile/{name}', array(
				'as'	=> 'account.profile',
				'uses'	=> 'UserController@show'
			));
			Route::get('account/edit/{slug}', array(
				'as'	=> 'account.edit',
				'uses'	=> 'UserController@edit'
			));
			Route::get('my-xtras', [
				'as'	=> 'account.xtras',
				'uses'	=> 'UserController@xtras']);
			Route::resource('account', 'UserController');
		});
	}

	protected function miscRoutes()
	{
		Route::group(['before' => 'auth', 'namespace' => 'Xtras\Controllers'], function()
		{
			Route::get('comments/{itemId}', 'CommentController@index');
			Route::post('comments/{itemId}', 'CommentController@store');
		});
	}

	protected function adminRoutes()
	{
		$groupOptions = [
			'before'	=> 'auth',
			'prefix'	=> 'admin',
			'namespace' => 'Xtras\Controllers\Admin'
		];

		Route::group($groupOptions, function()
		{
			Route::get('/', [
				'as'	=> 'admin',
				'uses'	=> 'AdminController@index']);

			Route::get('products/{id}/remove', 'ProductsController@remove');
			Route::get('types/{id}/remove', 'TypesController@remove');

			Route::resource('users', 'UsersController', ['except' => ['show']]);
			Route::resource('products', 'ProductsController', ['except' => ['show']]);
			Route::resource('types', 'TypesController', ['except' => ['show']]);
			Route::resource('items', 'ItemsController', ['except' => ['show']]);
		});
	}

}