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

Auth::routes();


Route::get('/redirect', 'SocialAuthFacebookController@redirect');
Route::get('/callback', 'SocialAuthFacebookController@callback');	


Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin'], function(){
    Route::group(['middleware' => 'guest'], function(){
        Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
        Route::post('login', ['as' => 'login', 'uses' => 'Auth\LoginController@login']);
    });
    Route::group(['middleware' =>  'admin'], function(){
        Route::get('home', function(){
            return view('admin.home');
        });
        Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

        Route::group(['prefix' => 'teacher', 'as' => 'teacher'], function(){
            Route::get('list-teacher', ['as' => 'list-teacher', 'uses' => 'Admin@listTeacher']);
            Route::get('add-teacher', function(){
                return view('admin.teacher.add');
            });
            Route::post('add-teacher',['as' => 'add-teacher', 'uses' =>'Admin@addTeacher']);
            Route::get('edit-teacher/{id}', ['as' => 'edit-teacher','uses' => 'Admin@editTeacher']);
            Route::post('edit-teacher/{id}', ['as' => 'post-edit-teacher','uses' => 'Admin@postEditTeacher']);
            Route::get('delete-teacher/{id}',['as' => 'delete-teacher', 'uses' => 'Admin@deleteTeacher']);


        });

        Route::group(['prefix' => 'student'], function(){
            Route::get('list-student', ['as' => 'list-student', 'uses' => 'Admin@listStudent']);
            Route::get('add-student', function(){
                return view('admin.student.add');
            });
            Route::post('add-student',['as' => 'add-student', 'uses' =>'Admin@addStudent']);
            Route::get('edit-student/{id}', ['as' => 'edit-student','uses' => 'Admin@editStudent']);
            Route::post('edit-student/{id}', ['as' => 'post-edit-student','uses' => 'Admin@postEditStudent']);
            Route::get('delete-student/{id}',['as' => 'delete-student', 'uses' => 'Admin@deleteStudent']);
        });

        Route::group(['prefix' => 'subject'], function(){
            Route::get('list-subject', ['as' => 'list-subject', 'uses' => 'Admin@listSubject']);
            Route::get('add-subject', function(){
                return view('admin.subjects.add');
            });
            Route::post('add-subject',['as' => 'add-subject', 'uses' =>'Admin@addSubject']);
            Route::get('edit-subject/{id}', ['as' => 'edit-subject','uses' => 'Admin@editSubject']);
            Route::post('edit-subject/{id}', ['as' => 'post-edit-subject','uses' => 'Admin@postEditSubject']);
            Route::get('delete-subject/{id}',['as' => 'delete-student', 'uses' => 'Admin@deleteSubject']);
        });

        Route::group(['prefix' => 'class'], function(){
            Route::get('list-class', ['as' => 'list-class', 'uses' => 'Admin@listClass']);
            Route::get('add-class', function(){
                $subject = App\Model\Subject::all();
                return view('admin.class.add', ['subject' => $subject]);
            });
            Route::post('add-class',['as' => 'add-class', 'uses' =>'Admin@addClass']);
            Route::get('edit-class/{id}', ['as' => 'edit-class','uses' => 'Admin@editClass']);
            Route::post('edit-class/{id}', ['as' => 'post-edit-class','uses' => 'Admin@postEditClass']);
            Route::get('delete-class/{id}',['as' => 'delete-class', 'uses' => 'Admin@deleteClass']);
        });

    });
});

Route::group(['namespace' => 'Student', 'prefix' => 'student', 'as' => 'student'], function(){
   Route::group(['middleware' => 'guest'], function(){
       Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
       Route::post('login', ['as' => 'login', 'uses' => 'Auth\LoginController@login']);
   });
   Route::group(['middleware' => 'student'], function(){
      Route::get('home', ['as' => 'home', function() {
          return view('student.home');
      }]);
      Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

   });
});
