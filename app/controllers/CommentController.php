<?php

class CommentController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$comments = Comment::all();

		return Response::json(array(
			'error'=>false,
			'comments'=>$comments->toArray()),
		200);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$comment = new Comment;
		$comment->user_id = Request::get('user_id');
		$comment->comment = Request::get('comment');
		$comment->photograph_id = Request::get('photograph_id');
		$comment->save();

		return Response::json(array(
			'error'=>false,
			'message'=>'Comment created'),
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
		$comment = Comment::find($id);

		return Response::json(array(
			'error'=>false,
			'comment'=>$comment->toArray()),
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
		$comment = Comment::find($id);

		if(Request::get('comment')){
			$comment->comment = Request::get('comment');
		}
		$comment->save();

		return Response::json(array(
			'error'=>false,
			'messsage'=>'comment updated'),
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
		$comment = Comment::find($id);
		$comment->delete();

		return Response::json(array(
			'error'=>false,
			'message'=>'comment deleted'),
		200);
	}


}
