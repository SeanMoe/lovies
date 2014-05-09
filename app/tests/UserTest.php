<?php

class UserTest extends ApiTester {
	//Arrange, Act, Assert

	/** @test */
	public function it_fetched_users(){
		$this->times(5)->make('User');

		$this->getJson('api/user');

		$this->assertResponseOk();

	}

	/** @test */
	public function it_fetches_a_single_user(){
		$this->make('User');

		$user = $this->getJson('api/user/1')->data;

		$this->assertResponseOk();
		$this->assertObjectHasAttributes($user, 'email','id');
	}

	/** @test */
	public function it_404s_if_a_user_is_not_found(){
		$json = $this->getJson('api/user/x');

		$this->assertResponseStatus(404);
		$this->assertObjectHasAttributes($json,'error');
	}

	/** @test */
	public function it_created_a_new_user_given_valid_parameters(){
		$this->getJson('api/user','POST',$this->getStub());

		$this->assertResponseStatus(201);
	}

	/** @test */
	public function it_throws_a_422_if_a_new_user_fails_validation(){
		$this->getJson('api/user','POST');

		$this->assertResponseStatus(422);
	}

	protected function getStub(){
		return [
			'email'=>$this->fake->email,
			'password'=>$this->fake->word($nb=12)
		];
	}

}
