<?php

class Photograph extends Eloquent {
	protected $fillable = array('user_id','geotag','isPublic','comment','photo');
	protected $table = 'photograph';

	public static function validate($input){
		$rules = array(
			'user_id'=>'required|numeric|exists:user,id',
			'comment'=>'required|alpha_num',
			'photo'=>'required|image',
			'isPublic'=>'digits:1|in:1,0'
			);

		return Validator::make($input,$rules);
	}
}