<?php

class FollowerSeeder extends Seeder
{
	public function run(){
		DB::table('follower')->delete();
		Follower::create(array(
			'user_id'=>'1',
			'follower'=>'2'
		));
		Follower::create(array(
			'user_id'=>'1',
			'follower'=>'3'
		));
		Follower::create(array(
			'user_id'=>'2',
			'follower'=>'1'
		));
		Follower::create(array(
			'user_id'=>'2',
			'follower'=>'3'
		));
		Follower::create(array(
			'user_id'=>'3',
			'follower'=>'2'
		));
	}
}