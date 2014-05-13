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
		$limit = Input::get('limit') ?: 3;

		if($limit > 100){
			$limit = 100;
		}

		$users = User::paginate($limit);

		return $this->respondWithPagination($users, ['data'=>$this->UserTransformer->transformCollection($users->all())]);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = User::validate(Input::all());
		if($validator->passes()){
			$password = Hash::make(Input::get('password'));
			User::create(['email'=>Input::get('email'), 'password'=>$password]);
			return $this->respondCreated('User Created');
		} else {
            $messages = $validator->messages();
            $respondMessage = '';
            foreach($messages->all() as $message){
                $respondMessage .= ' - '.$message;
            }
            return $this->respondCreateFailed($message);
		}
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

		$user = $this->UserTransformer->transform($user);

		return $this->respond([
			'data'=>$user
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
		$user = User::find($id);

		if(!$user){
			return $this->respondNotFound('User does not exist!');
		}

		if(Request::get('password')){
			$user->password = Hash::make(Request::get('password'));
		}  elseif(Request::get('email')){
			$user->email = Request::get('email');
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


    public function doLogin(){
        $rules = array(
            'email'=>'required|email',
            'password'=>'required|alpha_num|min:6'
        );
        $validator = Validator::make(Input::all(),$rules);
        if($validator->fails()){
            $messages = $validator->messages();
            $respondMessage = '';
            foreach($messages->all() as $message){
                $respondMessage .= ' - '.$message;
            }
            return $this->setStatusCode(422)->respondWithError($message);
        } else {
            $userdata = array(
                'email'=>Input::get('email'),
                'password'=>Input::get('password')
            );

            if(Auth::attempt($userdata)){
            	$user = Auth::user();
                return $this->respond(array('data'=>$user));
            } else {
                return $this->setStatusCode(404)->respondWithMessage("Username and/or password incorrect!");
            }
        }
    }

    public function doLogout(){
        Auth::logout();
        return $this->respondSuccess(array('data'=>array('message'=>'Logout Successful')));
    }

	public function followers($id){
		$user = User::find($id);

		if(!$user){
			return $this->respondNotFound('User does not exist!');
		}

		$followers = $user->followers;
		$data = array();
		foreach($followers as $user){
			$data[] = array(
				'id'=>$user->id,
				'email'=>$user->email);
		}
		if(empty($data)){
			return $this->respond([
				'message'=>'This user has no followers'
			]);
		}
		return $this->respond([
			'data'=>$data
			]);

	}

	public function following($id){
		$user = User::find($id);

		if(!$user){
			return $this->respondNotFound('User does not exist!');
		}
		$following = $user->following;
		$data = array();
		foreach($following as $user){
			$data[] = array(
				'id'=>$user->id,
				'email'=>$user->email);
		}
		if(empty($data)){
			return $this->respond([
				'message'=>'This user isnt following anyone!'
			]);
		}
		return $this->respond([
			'data'=>$data
			]);
	}

	public function follow($id1,$id2){
		$user1 = User::find($id1);
		$user2 = User::find($id2);

		if(!$user1 or !$user2){
			return $this->respondNotFound('User does not exist!');
		}

		$user1->following()->save($user2);
	}

	public function unfollow($id1, $id2){
		$user1 = User::find($id1);
		$user2 = User::find($id2);

		if(!$user1 or !$user2){
			return $this->respondNotFound('User does not exist!');
		}

		$user1->following()->delete($user2);
	}

	public function checkAuth(){
		return Auth::user();
	}

}
