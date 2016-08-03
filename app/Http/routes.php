<?php

use App\User;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Eleqouent Relationshiips
|--------------------------------------------------------------------------
*/

// Route::get('/user/{id}/post', function($id){
// 	return User::find($id)->post;
// });

// Route::get('post/{id}/user' , function($id){

// 	return POST::find($id)->user->name;
// });

// Route::get('/posts' , function(){

// 	$user = User::find(1);

// 	foreach($user->posts as $post)
// 	{
// 		echo $post->title;
// 	}
// });

// Route::get('/roles/{id}' , function($id){

// 	$user = User::find($id);

// 	foreach($user->roles as $role)
// 	{
// 		echo $role->name;
// 	}
// });

// Route::get('roles/pivot' , function(){

// 	$user = User::find('1');
// 	foreach ($user->roles as $role)
// 	{
// 		echo $role->pivot->created_at;
// 	}
// });

// Route::get( '/user/country' , function(){
// 	$country = Country::find(1);
// 	foreach ($country->posts as $post ) 
// 	{
// 		echo $post->title; 
// 	}
// });
Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/learn', 'HomeController@learn');

Route::get('/updatePoints', 'HomeController@updatePoints');