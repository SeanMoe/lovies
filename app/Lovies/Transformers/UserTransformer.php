<?php namespace Lovies\Transformers;

class UserTransformer extends Transformer{
	public function transform($user){
		return [
		'id'=>$user['id'],
		'username'=>$user['username']
		];
	}
}