<?php

class ArticleSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker\Factory::create();

		for ($a = 1; $a <= 50; $a++)
		{
			$article = ArticleModel::create([
				'product_id'	=> $faker->numberBetween(1, 5),
				'user_id'		=> $faker->numberBetween(1, 25),
				'title'			=> ucwords(implode(' ', $faker->words($faker->numberBetween(3, 10)))),
				'summary'		=> $faker->sentence(10),
				'slug'			=> '',
				'content'		=> implode("\r\n\r\n", $faker->paragraphs($faker->numberBetween(1, 10))),
			]);

			$tagLoops = $faker->numberBetween(1, 3);

			for ($t = 1; $t <= $tagLoops; $t++)
			{
				$article->tags()->attach($faker->numberBetween(1, 9));
			}

			$ratingLoops = $faker->numberBetween(0, 10);

			for ($f = 1; $f <= $ratingLoops; $f++)
			{
				$rating = RatingModel::create(['rating' => $faker->numberBetween(1, 5)]);

				$article->ratings()->save($rating);
			}

			$article->update(['rating' => $article->getRating()]);

			$commentsLoop = $faker->numberBetween(0, 10);

			for ($c = 1; $c <= $commentsLoop; $c++)
			{
				$comment = CommentModel::create([
					'user_id'	=> $faker->numberBetween(2, 25),
					'content'	=> $faker->text($faker->numberBetween(100, 500))
				]);

				$article->comments()->save($comment);
			}
		}
	}

}
