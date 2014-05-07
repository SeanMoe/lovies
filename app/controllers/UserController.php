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

		return Response::json(array(
			'error'=>false,
			'users'=>$this->UserTransformer->transformCollection($users->all())),
			200);
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

		return Response::json(array(
			'error'=>false,
			'user'=>$this->UserTransformer->transform($user)),
			200);
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

}
