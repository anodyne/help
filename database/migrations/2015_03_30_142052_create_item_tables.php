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
			['name' => "Nova NextGen", 'slug' => "nova-3", 'description' => "Nova NextGen is the culmination of everything we've learned about RPG management since the day we released the first version of the SIMM Management System. Every version, be it SMS or Nova, has been a little better than the one that came before it. When thinking about the future though, we came to the inescapable conclusion that Nova is broken. Creating software that does something and does it well is only half the battle; every iteration needs to be better, smarter, faster, and more efficient than the previous. In order to do that, we had to re-think what Nova is, what it should be, and what it ultimately can be. This is the next generation."],
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
			['name' => "General Information"],
			['name' => "Error"],
		];

		foreach ($tags as $tag)
		{
			$tag['slug'] = "";
			
			Tag::create($tag);
		}
	}

}
