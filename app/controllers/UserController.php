<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = User::all();

		return Response::json(array(
			'error'=>false,
			'urls'=>$user->toArray()),
			200
		);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$user = new User;
		$user->username = Request::get('username');
		$user->password = Hash::make(Request::get('password'));
		$user->save();

		return Response::json(array(
			'errors'=>false,
			'users'=>$users->toArray()),
		200
		);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::where('id',$id)
		->take(1)
		->get();

		return Response::json(array(
			'errors'=>false,
			$user->toArray()),
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
		$user->delete();

		return Response::json(array(
			'errors'=>false,
			'message'=>'User deleted'),
		200
		);
	}


}
