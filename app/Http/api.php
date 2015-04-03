<?php

Route::group([], function()
{
	Route::get('articles', 'ArticleController@index');
	Route::get('articles/trashed', 'ArticleController@trashed');
});
