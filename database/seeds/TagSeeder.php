<?php

class TagSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$tags = [
			['name' => 'Getting Started', 'slug' => ''],
			['name' => 'Install Guide', 'slug' => ''],
			['name' => 'Update Guide', 'slug' => ''],
			['name' => 'Upgrade Guide', 'slug' => ''],
			['name' => 'Developers', 'slug' => ''],
			['name' => 'Skinning', 'slug' => ''],
			['name' => 'Help', 'slug' => ''],
			['name' => 'Tutorial', 'slug' => ''],
			['name' => 'FAQ', 'slug' => ''],
		];

		foreach ($tags as $tag)
		{
			Tag::create($tag);
		}
	}

}