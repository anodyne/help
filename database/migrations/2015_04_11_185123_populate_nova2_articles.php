<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PopulateNova2Articles extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$articles = [];

		foreach ($articles as $article)
		{
			$article['product_id'] = 2;
			$article['user_id'] = 1;

			$tags = (array_key_exists('tags', $article)) ? $article['tags'] : null;
			unset($article['tags']);

			$item = Article::create($article);

			if ($tags)
			{
				$item->tags()->sync($tags);
			}
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Article::where('product_id', 2)->delete();
	}

}
