<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class FollowTableSeeder extends ApiSeeder{

	public function run()
	{
		//needs to be 2 real user IDs
		$faker = Faker::create();

		$userIds = User::lists('id');

		$follower_id = $faker->randomElement($userIds);
		$followed_id = $faker->randomElement($userIds);
		while($followed_id == $follower_id){
			$followed_id = $faker->randomElement($userIds);			
		}

		DB::table('follow')->insert([
			'follower_id'=>$follower_id,
			'followed_id'=>$followed_id,
			]);

		DB::table('follow')->insert([
			'follower_id'=>$followed_id,
			'followed_id'=>$follower_id,
			]);
	}

}