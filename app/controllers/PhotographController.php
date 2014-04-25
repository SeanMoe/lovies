<?php

class PhotographController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$photograph = Photograph::all();

		return Response::json(array(
			'error'=>false,
			'photographs'=>$photograph->toArray()),
		200);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$photograph = new Photograph;
		$photograph->user_id = Request::get('user_id');
		$photograph->comment = Request::get('comment');
		$photograph->geotag = Request::get('geotag');
		$photograph->isPublic = Request::get('isPublic');
		$photograph->save();

		return Response::json(array(
			'error'=>false,
			'message'=>'Photograph created'),
		200);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$photograph = Photograph::find($id);

		return Response::json(array(
			'error'=>false,
			'photograph'=>$photograph->toArray()),
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
		$photograph = Photograph::find($id);

		if(Request::get('comment')){
			$photograph->comment = Request::get('comment');
		}
		if(Request::get('isPublic')){
			$photograph->isPublic = Request::get('isPublic');
		}
		$photograph->save();

		return Response::json(array(
			'error'=>false,
			'message'=>'Photograph #$id updated'),
		200);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$photograph = Photograph::find($id);
		$photograph->delete();

		return Response::json(array(
			'error'=>false,
			'message'=>'Photograph #$id deleted'),
		200);
	}


}
