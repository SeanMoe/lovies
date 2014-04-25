<?php
class CommentSeeder extends Seeder {
	public function run(){
		DB::table('comment')->delete();
		Comment::create(array(
			'user_id'=>'1',
			'photograph_id'=>'1',
			'comment'=>'This is a comment'
		));
	}
}