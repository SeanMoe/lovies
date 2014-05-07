<?php

use Faker\Factory as Faker;
abstract class ApiTester extends TestCase {

	protected $faker;

	protected $times = 1;

	function __construct(){
		$this->fake = Faker::create();
	}

	public function setUp(){
		parent::setUp();

		Artisan::call('migrate');
	}

	protected function times($count){
		$this->times = $count;

		return $this;
	}

	protected function getJson($uri){

		return json_decode($this->call('GET',$uri)->getContent());
	}

	protected function assertObjectHasAttributes(){
		$args = func_get_args();
		$object = array_shift($args);

		foreach($args as $attribute){
			$this->assertObjectHasAttribute($attribute,$object);
		}
	}

	/**
	 * make new record
	 * @param  string $type 
	 * @param  array $fields
	 */
	protected function make($type, array $fields = []){
		while($this->times--){
			$stub = array_merge($this->getStub(),$fields);
			$type::create($stub);
		}
	}

	/**
	 * Throws an error if trying to call make without getStub
	 */
	protected function getStub(){
		throw new BadMethodCallException("Create your own getStub method to declare fields");
	}

}