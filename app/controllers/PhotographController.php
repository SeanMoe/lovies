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
		$limit = Input::get('limit') ?: 3;

		if($limit > 100){
			$limit = 100;
		}

		$photographs = Photograph::orderBy('id','DESC')->paginate($limit);

		return $this->respondWithPagination($photographs,['data'=>$this->PhotographTransformer->transformCollection($photographs->all())]);

	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Photograph::validate(Input::all());
		if($validator->passes()){
			$filename = str_random(12) . Input::file('photo')->getClientOriginalName();
			$destination = 'photos';

			$upload = Input::file('photo')->move($destination,$filename);
			if($upload){
				$photograph = new Photograph;
				$photograph->user_id = Input::get('user_id');
				$photograph->comment = Input::get('comment');
				$photograph->isPublic = Input::get('isPublic');
				$photograph->photo = $filename;
				$photograph->save();
			} else {
				return $this->respondCreateFailed("Could not upload file");
			}

		} else {
			$messages = $validator->messages();
			$respondMessage = '';
			foreach($messages->all() as $message){
				$respondMessage .= ' - '.$message;
			}
			return $this->respondCreateFailed($message);
		}

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

		$photograph = $this->PhotographTransformer->transform($photograph);

	  	return $this->respond([
	  		'data'=>$photograph
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

		File::delete('photos/'.$photograph->photo);

		$photograph->delete();

		return $this->respondSuccess('Photograph Deleted');
	}


}
