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
		$this->assertObjectHasAttributes($user, 'username','id');
	}

	/** @test */
	public function it_404s_if_a_user_is_not_found(){
		$this->getJson('api/user/x');

		$this->assertResponseStatus(404);
	}

	protected function getStub(){
		return [
			'username'=>$this->fake->userName,
			'password'=>$this->fake->word
		];
	}

}
