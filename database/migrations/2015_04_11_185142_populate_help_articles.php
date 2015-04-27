<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PopulateHelpArticles extends Migration {

	protected $productId = 5;

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		foreach ($this->articles() as $article)
		{
			$article['product_id'] = $this->productId;
			$article['user_id'] = 1;
			$article['published'] = (int) true;

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
		Article::where('product_id', $this->productId)->delete();
	}

	protected function articles()
	{
		return [];
	}

}
