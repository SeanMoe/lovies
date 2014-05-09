<?php

class PhotographSeeder extends Seeder
{
	public function run(){

		DB::table('photograph')->delete();
		Photograph::create(array(
			'user_id'=>'1',
			'photo'=>'http://placehold.it/350x150',
			'comment'=>'Initial Photograph Comment',
			'isPublic'=>'0'
			));
	}
}