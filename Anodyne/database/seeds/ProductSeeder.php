<?php

class ProductSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$products = [
			['name' => 'Nova 1', 'slug' => ''],
			['name' => 'Nova 2', 'slug' => ''],
			['name' => 'Nova 3', 'slug' => ''],
			['name' => 'AnodyneXtras', 'slug' => ''],
			['name' => 'Anodyne Help Center', 'slug' => ''],
		];

		foreach ($products as $product)
		{
			Product::create($product);
		}
	}

}
