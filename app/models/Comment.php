<?php

Class Comment extends Eloquent {
	protected $table = 'comment';

    public static function validate($input){
        $rules = array(
            'comment'=>'required|alpha_dash',
            'user_id'=>'required|exists:user,id|numeric',
            'photograph_id'=>'required|exists:photograph,id|numeric'
        );

        return Validator::make($input,$rules);
    }
}