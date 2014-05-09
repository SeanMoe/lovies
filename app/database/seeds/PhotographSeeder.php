<?php

class PhotographSeeder extends ApiSeeder{
	public function run(){

		DB::table('photograph')->delete();
		$userIds = User::lists('id');
		foreach(range(1,30) as $index){
			Photograph::create(array(
				'user_id'=>$this->fake->randomElement($userIds),
				'photo'=>$this->fake->word.'.jpg',
				'comment'=>$this->fake->sentence(1),
				'isPublic'=>$this->fake->boolean));
		}
	}
}