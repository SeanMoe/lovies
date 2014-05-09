<?php


class UserSeeder extends ApiSeeder
{
	public function run(){
		DB::table('user')->delete();
		User::create(array(			
			'email'=>'malolas@gmail.com',
			'password'=>Hash::make('fluffybunny'),
			));

		for($i = 0;$i<10;$i++){
			User::create(array(
				'email'=>$this->fake->email,
				'password'=>Hash::make($this->fake->word($nb=12))
				));
		}
	}
}