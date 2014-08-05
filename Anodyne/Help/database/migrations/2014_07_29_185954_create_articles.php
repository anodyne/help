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
			$table->integer('user_id')->unsigned();
			$table->string('title');
			$table->string('summary');
			$table->string('slug');
			$table->text('content');
			$table->integer('status');
			$table->float('rating')->default(0);
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('articles_flags', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->bigInteger('article_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->string('type');
			$table->text('notes')->nullable();
			$table->boolean('resolved')->default((int) false);
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('articles');
		Schema::drop('articles_flags');
	}

}