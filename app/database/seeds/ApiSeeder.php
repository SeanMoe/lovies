<?php

use Faker\Factory as Faker;
class ApiSeeder extends Seeder{

	protected $faker;

	function __construct(){
		$this->fake = Faker::create();
	}
}