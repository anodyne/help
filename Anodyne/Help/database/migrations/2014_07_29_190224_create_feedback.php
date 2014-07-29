<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedback extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->bigInteger('article_id')->unsigned();
			$table->integer('user_id')->unsigned();
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
		Schema::drop('comments');
		Schema::drop('ratings');
	}

}
