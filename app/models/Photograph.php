<?php

class Photograph extends Eloquent {
	protected $fillable = array('user_id','geotag','isPublic','comment');
	protected $table = 'photograph';
}