<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('follower', function(Blueprint $table)
		{
			$table->increments('id')->unsigned;
			$table->integer('user_id')->unsigned;
			$table->integer('follower_id')->unsigned;
			$table->timestamps();
			$table->unique(array('user_id','follower_id'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('follower');
	}

}
