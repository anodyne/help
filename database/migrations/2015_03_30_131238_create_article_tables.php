<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('articles', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->integer('product_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->string('title');
			$table->string('slug');
			$table->text('summary');
			$table->longText('content');
			$table->text('keywords')->nullable();
			$table->boolean('featured')->default((int) false);
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('articles_ratings', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->bigInteger('article_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->smallInteger('rating');
		});

		Schema::create('articles_reviews', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->bigInteger('article_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->string('type')->default('review');
			$table->text('comments')->nullable();
			$table->string('resolution')->nullable();
			$table->text('notes')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('articles_tags', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->bigInteger('article_id')->unsigned();
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
		Schema::dropIfExists('articles');
		Schema::dropIfExists('articles_ratings');
		Schema::dropIfExists('articles_reviews');
		Schema::dropIfExists('articles_tags');
	}

}
