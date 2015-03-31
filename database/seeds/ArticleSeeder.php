<?php

use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder {

	public function run()
	{
		foreach ($this->nova1() as $article)
		{
			$article['product_id'] = 1;
			$article['user_id'] = 1;

			$tags = (array_key_exists('tags', $article)) ? $article['tags'] : null;
			unset($article['tags']);

			$item = Article::create($article);

			if ($tags)
			{
				$item->tags()->sync($tags);
			}
		}

		foreach ($this->nova2() as $article)
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

		foreach ($this->nova3() as $article)
		{
			$article['product_id'] = 3;
			$article['user_id'] = 1;

			$tags = (array_key_exists('tags', $article)) ? $article['tags'] : null;
			unset($article['tags']);

			$item = Article::create($article);

			if ($tags)
			{
				$item->tags()->sync($tags);
			}
		}

		foreach ($this->xtras() as $article)
		{
			$article['product_id'] = 4;
			$article['user_id'] = 1;

			$tags = (array_key_exists('tags', $article)) ? $article['tags'] : null;
			unset($article['tags']);

			$item = Article::create($article);

			if ($tags)
			{
				$item->tags()->sync($tags);
			}
		}

		foreach ($this->help() as $article)
		{
			$article['product_id'] = 5;
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

	protected function nova1()
	{
		return [];
	}

	protected function nova2()
	{
		return [];
	}

	protected function nova3()
	{
		return [];
	}

	protected function xtras()
	{
		return [
			['title' => "AnodyneXtras FAQs", 'slug' => "", 'summary' => "", 'content' => "", 'tags' => [5]],
			['title' => "Getting Started with AnodyneXtras", 'slug' => "", 'summary' => "", 'content' => "", 'tags' => [1]],
		];
	}

	protected function help()
	{
		return [
			['title' => "Sharing Articles", 'slug' => "", 'summary' => "", 'content' => "", 'tags' => [5]],
			['title' => "Requesting Updates to an Article", 'slug' => "", 'summary' => "", 'content' => "", 'tags' => [5]],
		];
	}

}
