<?php

use Illuminate\Http\Response as IlluminateResponse;

class ApiController extends BaseController{ 


	/**
	 * @var integer
	 */
	protected $statusCode = IlluminateResponse::HTTP_OK;

	public function getStatusCode(){
		return $this->statusCode;
	}

	public function setStatusCode($statusCode){
		$this->statusCode = $statusCode;

		return $this;
	}

	public function respondNotFound($message = 'Not Found!'){
		return $this->setStatusCode(IlluminateResponse::HTTP_NOT_FOUND)->respondWithError($message);
	}

	public function respondInternalError($message = "Internal Error!"){
		return $this->setStatusCode(IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR)->respondWithError($message);
	}

	public function respondSuccess($message = "Succesful"){
		return $this->setStatusCode(IlluminateResponse::HTTP_OK)->respondWithMessage($message);
	}

	public function respondCreated($message = "Successfully Created"){
		return $this->setStatusCode(IlluminateResponse::HTTP_CREATED)->respondWithMessage($message);
	}

	public function respondCreateFailed($message = "Failed to create"){
		return $this->setStatusCode(IlluminateResponse::HTTP_UNPROCESSABLE_ENTITY)->respondWithError($message);
	}

	public function respond($data, $headers = []){
		return Response::json($data, $this->getStatusCode(), $headers);
	}

	public function respondWithArrayAndMessage(array $array, $message){
		return $this->respond([
			'data'=>$array,
			'message'=>$message,
			'status_code'=>$this->getStatusCode()
			]);
	}

	public function respondWithMessage($message){
		return $this->respond([
			'error'=>false,
			'message'=>$message,
			'status_code'=>$this->getStatusCode()
			]);
	}

	public function respondWithError($message){
		return $this->respond([
			'error'=>true,
			'message' => $message,
			'status_code' => $this->getStatusCode()
		]);
	}
}