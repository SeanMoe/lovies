<?php

class CommentController extends ApiController {

	protected $CommentTransformer;

	function __construct(Lovies\Transformers\CommentTransformer $CommentTransformer){
		$this->CommentTransformer = $CommentTransformer;
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

		$comments = Comment::paginate($limit);

		return $this->respondWithPagination($comments,['data'=>$this->CommentTransformer->transformCollection($comments->all())]);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if (! Input::get('user_id') or ! Input::get('comment') or ! Input::get('photograph_id')){
			return $this->respondCreateFailed('Parameters failed validation');
		}

		$comment = new Comment;		
		$comment->user_id = Request::get('user_id');
		$comment->comment = Request::get('comment');
		$comment->photograph_id = Request::get('photograph_id');
		$comment->save();

		return $this->respondCreated('Comment created!');
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

		if(!$comment){
			return $this->respondNotFound('Could not find comment');
		}

		$comment = $this->CommentTransformer->transform($comment);

		return $this->respond([
			'data'=>$comment
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
		$comment = Comment::find($id);

		if(!$comment){
			return $this->respondNotFound('Comment not found');
		}

		if(Request::get('comment')){
			$comment->comment = Request::get('comment');
			$comment->save();
			return $this->respondCreated('Comment updated');
		} else {
			return $this->respondCreateFailed('Parameters failed validation');
		} 
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
		if(!$comment){
			return $this->respondNotFound('Comment not found');
		}
		$comment->delete();

		return $this->respondSuccess("Comment Deleted");
	}


}
