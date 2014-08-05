<?php

Route::get('ratings', function()
{
	$a = ArticleModel::first();
	s($a->getRating());
});