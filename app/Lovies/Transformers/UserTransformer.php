<?php namespace Lovies\Transformers;

class UserTransformer extends Transformer{
	public function transform($user){
		return [
		'id'=>$user['id'],
		'email'=>$user['email'],
		'token'=>$user['remember_token']
		];
	}
}