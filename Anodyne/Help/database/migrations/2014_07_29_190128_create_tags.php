<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTags extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tags', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->text('desc')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('articles_tags', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->bigInteger('article_id')->unsigned();
			$table->integer('tag_id')->unsigned();
		});

		Schema::create('products_tags', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('product_id')->unsigned();
			$table->integer('tag_id')->unsigned();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tags');
		Schema::drop('articles_tags');
		Schema::drop('products_tags');
	}

}
