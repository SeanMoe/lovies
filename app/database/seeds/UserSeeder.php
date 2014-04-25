<?php

/*			$table->increments('id');
			$table->string('remember_token',100)->nullable();
			$table->string('username', 32)->unique();
			$table->string('password', 64); */

class UserSeeder extends Seeder
{
	public function run(){
		DB::table('user')->delete();
		User::create(array(			
			'username'=>'Seanmoe',
			'password'=>Hash::make('fluffybunny'),
			));

		User::create(array(			
			'username'=>'mkeltner',
			'password'=>Hash::make('fluffybunny'),
			));

		User::create(array(
			'username'=>'cdean',
			'password'=>Hash::make('fluffybunny'),
			));
	}
}