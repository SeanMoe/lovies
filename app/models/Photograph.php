<?php

class Photograph extends Eloquent {
	protected $fillable = array('user_id','isPublic','comment','photo');
	protected $table = 'photograph';

	public static function validate($input){
		$rules = array(
			'user_id'=>'required|numeric|exists:user,id',
			'comment'=>'required|alpha_num',
			'photo'=>'required|image'
			);

		return Validator::make($input,$rules);
	}
}