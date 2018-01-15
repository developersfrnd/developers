<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(array('prefix'=> config('constants.ADMIN_URL')), function ()	{

		Route::get('/','Admin\AuthController@getlogin');
		Route::post('/','Admin\AuthController@postLogin');

		Route::group(['middleware'=>['auth','admin']], function(){

		
			Route::get('/logout','Admin\AuthController@logout')->name('logout');
			Route::get('/dashboard','Admin\AuthController@dashboard');
			Route::resource('/categories','Admin\CategoriesController');

			Route::resource('/blogs','Admin\BlogsController');
		});	
	});
