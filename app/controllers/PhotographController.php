<?php

class PhotographController extends ApiController {

	protected $PhotographTransformer;

	function __construct(Lovies\Transformers\PhotographTransformer $PhotographTransformer){
		$this->PhotographTransformer = $PhotographTransformer;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$photograph = Photograph::all();

		$photographs = $this->PhotographTransformer->transformCollection($photograph->all());

		//return $this->respondWithArrayAndMessage($photographs, 'Photographs found');

	  	return Response::json(array(
			'error'=>false,
			'photographs'=>$this->PhotographTransformer->transformCollection($photograph->all())),
		200);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(! Input::get('user_id') or ! Input::get('comment')){
			return $this->respondCreateFailed('Parameters failed validation');
		}
		Photograph::create(Input::all());

		return $this->respondCreated('Photograph created');
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

		if(!$photograph){
			return $this->respondNotFound('Photograph not found');
		}

	  	return Response::json(array(
			'error'=>false,
			'photograph'=>$this->PhotographTransformer->transform($photograph)),
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

		if(!$photograph){
			return $this->respondNotFound('Photograph not found');
		}

		if(Request::get('comment')){
			$photograph->comment = Request::get('comment');
		}
		if(Request::get('isPublic')){
			$photograph->isPublic = Request::get('isPublic');
		}
		$photograph->save();

		return $this->respondSuccess('Photograph Updated');
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

		if(!$photograph){
			return $this->respondNotFound('Photograph not found');
		}

		$photograph->delete();

		return $this->respondSuccess('Photograph Deleted');
	}


}
