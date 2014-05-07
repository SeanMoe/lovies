<?php namespace Lovies\Transformers;

class CommentTransformer extends Transformer{
	public function transform($photograph){
		return [
		'id'=>$photograph['id'],
		'user_id'=>$photograph['user_id'],
		'comment'=>$photograph['comment']
		];
	}
}