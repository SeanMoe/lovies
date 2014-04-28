<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('/authtest',array('before'=>'auth.basic',function(){
	return "Test";
}));

Route::group(array('prefix'=>'api','before'=>'auth.basic'),function(){
  Route::resource('user','UserController');
  Route::resource('photograph','PhotographController');
  Route::resource('comment','CommentController');
  Route::get('follower/follow/{id}', array('uses'=>'FollowerController@follow'));
  Route::get('follower/usertofollow/{user1}/{user2}', array('uses'=>'FollowerController@follow'));
  Route::get('follower/followers/{id}',array('uses'=>'FollowerController@getFollowers'));
});

App::missing(function($exception){
  return View::make('hello');
});
