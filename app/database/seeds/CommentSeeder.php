<?php
class CommentSeeder extends ApiSeeder {
	public function run(){
		DB::table('comment')->delete();
		$userIds = User::lists('id');
		$photoIds = Photograph::lists('id');
		foreach(range(1,40) as $index){
			Comment::create(array(
				'user_id'=>$this->fake->randomElement($userIds),
				'photograph_id'=>$this->fake->randomElement($photoIds),
				'comment'=>$this->fake->sentence(1)));
		}
	}
}