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
			['name' => 'Getting Started'],
			['name' => 'Install Guide'],
			['name' => 'Update Guide'],
			['name' => 'Upgrade Guide'],
			['name' => 'Developers'],
			['name' => 'Skinning'],
			['name' => 'Help'],
			['name' => 'Tutorial'],
			['name' => 'FAQ'],
		];

		foreach ($tags as $tag)
		{
			TagModel::create($tag);
		}
	}

}