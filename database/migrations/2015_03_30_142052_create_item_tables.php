<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('slug');
			$table->boolean('display')->default((int) true);
			$table->text('description')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('tags', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('slug');
			$table->boolean('display')->default((int) true);
			$table->timestamps();
			$table->softDeletes();
		});

		$this->populateTables();
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('products');
		Schema::dropIfExists('tags');
	}

	protected function populateTables()
	{
		$products = [
			['name' => "Nova 1", 'slug' => "nova-1"],
			['name' => "Nova 2", 'slug' => "nova-2"],
			['name' => "Nova 3", 'slug' => "nova-3"],
			['name' => "AnodyneXtras", 'slug' => "xtras"],
			['name' => "Anodyne Help Center", 'slug' => "help-center"],
			['name' => "Anodyne Productions", 'slug' => "anodyne"],
		];

		foreach ($products as $product)
		{
			Product::create($product);
		}

		$tags = [
			['name' => "Getting Started"],
			['name' => "Tutorial"],
			['name' => "Install Guide"],
			['name' => "Update Guide"],
			['name' => "FAQ"],
			['name' => "Skinning"],
			['name' => "Developer Resource"],
			['name' => "Changelog"],
			['name' => "Reference"],
		];

		foreach ($tags as $tag)
		{
			$tag['slug'] = "";
			
			Tag::create($tag);
		}
	}

}
