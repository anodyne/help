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
			['name' => 'Nova 1'],
			['name' => 'Nova 2'],
			['name' => 'Nova 3'],
			['name' => 'AnodyneXtras'],
			['name' => 'Anodyne Help Center'],
		];

		foreach ($products as $product)
		{
			ProductModel::create($product);
		}
	}

}