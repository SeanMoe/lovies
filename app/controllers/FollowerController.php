<?php

class FollowerController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	public function follow($id){
		$user = User::find(Auth::user()->id);
		$user2 = User::find($id);
		if (!$user2){
			$error = 1;
			$message = "User not found!";
		}
		if($user1 == $user2){
			$error =1;
			$message = "Cant follow yourself!";
		}
		if($error){
			return Response::json(array(
			'error'=>true,
			'message'=>$message));
		}

		$user->follow()->save($user2);

		return Response::json(array(
			'error'=>false,
			'message'=>'followers created'),
		200);
	}

	public function usertofollow($id1,$id2){
		$user1 = User::find($id1);
		$user2 = User::find($id2);

	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
