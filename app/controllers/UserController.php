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
		$users = User::all();

		$users = $this->UserTransformer->transformCollection($users->all());
		return $this->respond([
			'data'=>$users
			]);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$user = new User;
		if (! Input::get('username') or ! Input::get('password')){
			$this->respondCreateFailed("Parameters failed validation");
		}
		$user->username = Request::get('username');
		$user->password = Hash::make(Request::get('password'));
		$user->save();

		return $this->respondCreated('User Updated');
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
		}  elseif(Request::get('username')){
			$user->username = Request::get('username');
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
			$data[] = $follower->username;
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
			$data[] = $user->username;
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
