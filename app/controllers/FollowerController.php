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
		$user1 = User::find(Auth::user()->id);
		$user2 = User::find($id);
		$error = false;
		if (!$user2){
			$error = true;
			$message = "User not found!";
			return Response::json(array(
				'error'=>true,
				'message'=>$message),
			200);
		}

		$user1->follow()->save($user2);

		return Response::json(array(
			'error'=>false,
			'message'=>'followers created'),
		200);
	}

	public function usertofollow($id1,$id2){
		$user1 = User::find($id1);
		$user2 = User::find($id2);

		$user1->follow()->save($user2);

		return Response::json(array(
			'error'=>false),
		200);
	}

	public function getFollowers($id){
		$user1 = User::find($id);
		$followers = $user1->followers;

		return Response::json(array(
			'error'=>false,
			'followers'=>$followers->toArray()),
		200);
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
