<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticles extends Migration {

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
			$table->bigInteger('user_id')->unsigned();
			$table->string('title');
			$table->string('summary');
			$table->string('slug');
			$table->text('content');
			$table->float('rating')->default(0);
			$table->boolean('status')->default((int) true);
			$table->boolean('admin_status')->default((int) true);
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('articles_reviews', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->bigInteger('article_id')->unsigned();
			$table->bigInteger('user_id')->unsigned();
			$table->string('type');
			$table->text('notes')->nullable();
			$table->boolean('resolved')->default((int) false);
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('articles_tags', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->bigInteger('article_id')->unsigned();
			$table->integer('tag_id')->unsigned();
		});

		Schema::create('comments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->bigInteger('article_id')->unsigned();
			$table->bigInteger('user_id')->unsigned();
			$table->text('content');
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('ratings', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->bigInteger('article_id')->unsigned();
			$table->integer('rating');
			$table->timestamps();
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
		Schema::dropIfExists('articles_reviews');
		Schema::dropIfExists('articles_tags');
		Schema::dropIfExists('comments');
		Schema::dropIfExists('ratings');
	}

}