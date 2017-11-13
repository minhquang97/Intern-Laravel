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

Route::post('student/search' , 'StudentController@search');


Route::resource('student', 'StudentController');


Route::get('/view',function() {
	return view('welcome');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/testdb','TestEloquent@testdb');

Route::get('/redirect', 'SocialAuthFacebookController@redirect');
Route::get('/callback', 'SocialAuthFacebookController@callback');	


Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function(){
    Route::group(['middleware' => 'guest'], function(){
        Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
        Route::post('login', ['as' => 'login', 'uses' => 'Auth\LoginController@login']);
    });
    Route::group(['middleware' =>  'admin'], function(){
        Route::get('home', function(){
            return view('admin.home');
        });
        Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
        Route::get('teacher', ['as' => 'teacher', 'uses' => 'Admin@listTeacher']);
        Route::get('add-teacher', function(){
            return view('admin.teacher.add');
        });
        Route::post('add-teacher',['as' => 'add-teacher', 'uses' =>'Admin@addTeacher']);
        Route::get('edit-teacher/{id}', ['as' => 'edit-teacher','uses' => 'Admin@editTeacher']);
        Route::post('edit-teacher', ['as' => 'post-edit-teacher','uses' => 'Admin@postEditTeacher']);

    });
});