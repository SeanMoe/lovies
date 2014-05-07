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

Route::group(array('prefix'=>'api'),function(){
  Route::resource('user','UserController',array('except'=>array('create','edit')));
  Route::resource('photograph','PhotographController', array('except'=>array('create', 'edit')));
  Route::resource('comment','CommentController', array('except'=>array('create','edit')));
  //Get all followers of user {id}
  Route::get('user/{id}/followers','UserController@followers');
  //Get all user {id} is following
  Route::get('user/{id}/following','UserController@following');
  //Create where user {id1} follows user {id2};
  Route::post('user/{id1}/follow/{id2}','UserController@follow');
  //Deletes a follower / Unfollows
  Route::delete('user/{id1}/follow/{id2}','UserController@unfollow');
});

App::missing(function($exception){
  return View::make('hello');
});
