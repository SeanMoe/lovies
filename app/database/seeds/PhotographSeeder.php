<?php

class PhotographSeeder extends Seeder
{
	public function run(){
		DB::table('photograph')->delete();
		Photograph::create(array(
			'user_id'=>'1',
			'geotag'=>'123141,124125131',
			'comment'=>'Initial Photograph Comment',
			'isPublic'=>'0'
			));
	}
}