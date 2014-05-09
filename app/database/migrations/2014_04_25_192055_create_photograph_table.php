<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotographTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('photograph', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->text('photo');			
			$table->text('comment');
			$table->boolean('isPublic')->default(False);
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
		Schema::drop('photograph');
	}

}
