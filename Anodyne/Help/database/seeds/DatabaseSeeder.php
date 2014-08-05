<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call('ProductSeeder');
		$this->call('TagSeeder');

		if (App::environment() != 'production')
		{
			$this->call('ArticleSeeder');
			//$this->call('QuestionSeeder');
		}
	}

}