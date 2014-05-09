<?php

class UserController extends ApiController {

	/**
	 * @var lovies\transformers\UserTransformer
	 */
	protected $UserTransformer;

  	function __construct(Lovies\Transformers\UserTransformer $UserTransformer){
  		$this->UserTransformer = $UserTransformer;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$limit = Input::get('limit') ?: 3;

		if($limit > 100){
			$limit = 100;
		}

		$users = User::paginate($limit);

		return $this->respondWithPagination($users, ['data'=>$this->UserTransformer->transformCollection($users->all())]);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = User::validate(Input::all());
		if($validator->passes()){
			$password = Hash::make(Input::get('password'));
			User::create(['email'=>Input::get('email'), 'password'=>$password]);
			return $this->respondCreated('User Created');
		} else {
			return $this->setStatusCode(422)->respondWithError('Fields did not pass validation');
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::find($id);

		if(!$user){
			return $this->respondNotFound('User does not exist!');
		}

		$user = $this->UserTransformer->transform($user);

		return $this->respond([
			'data'=>$user
			]);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = User::find($id);

		if(!$user){
			return $this->respondNotFound('User does not exist!');
		}

		if(Request::get('password')){
			$user->password = Hash::make(Request::get('password'));
		}  elseif(Request::get('email')){
			$user->email = Request::get('email');
		} else {
			return $this->setResponseCode(303)->respondWithError('No Options given!');
		}

		return $this->respondSuccess('User Updated');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = User::find($id);

		if(!$user){
			return $this->respondNotFound('User does not exist!');
		}

		$user->delete();

		return $this->respondSuccess('User Deleted');
	}

	public function followers($id){
		$user = User::find($id);

		if(!$user){
			return $this->respondNotFound('User does not exist!');
		}

		$followers = $user->followers;

		foreach($followers as $follower){
			$data[] = $follower->email;
		}

		return $this->respond([
			'data'=>$data
			]);

	}

	public function following($id){
		$user = User::find($id);

		if(!$user){
			return $this->respondNotFound('User does not exist!');
		}

		$following = $user->following;

		foreach($following as $user){
			$data[] = $user->email;
		}


		return $this->respond([
			'data'=>$data
			]);
	}

	public function follow($id1,$id2){
		$user1 = User::find($id1);
		$user2 = User::find($id2);

		if(!$user1 or !$user2){
			return $this->respondNotFound('User does not exist!');
		}

		$user1->following()->save($user2);
	}

	public function unfollow($id1, $id2){
		$user1 = User::find($id1);
		$user2 = User::find($id2);

		if(!$user1 or !$user2){
			return $this->respondNotFound('User does not exist!');
		}

		$user1->following()->delete($user2);
	}

}
