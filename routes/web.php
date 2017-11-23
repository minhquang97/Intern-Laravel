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


Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.'], function(){
    Route::group(['middleware' => 'guest'], function(){
        Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
        Route::post('login', ['as' => 'post-login', 'uses' => 'Auth\LoginController@login']);
    });
    Route::group(['middleware' =>  'admin'], function(){
        Route::get('home', ['as' =>'home', function(){
            return view('admin.home');
        }]);
        Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

        Route::group(['prefix' => 'teacher', 'as' => 'teacher.'], function(){
            Route::get('list-teacher', ['as' => 'list-teacher', 'uses' => 'Admin@listTeacher']);
            Route::get('add-teacher', function(){
                return view('admin.teacher.add');
            })->name('admin.teacher.get-add-teacher');
            Route::post('add-teacher',['as' => 'post-add-teacher', 'uses' =>'Admin@addTeacher']);
            Route::get('edit-teacher/{id}', ['as' => 'get-edit-teacher','uses' => 'Admin@editTeacher']);
            Route::post('edit-teacher/{id}', ['as' => 'post-edit-teacher','uses' => 'Admin@postEditTeacher']);
            Route::get('info-teacher/{id}', ['as' => 'info-teacher', 'uses' => 'Admin@infoTeacher']);
            Route::delete('delete-teacher/{id}',['as' => 'delete-teacher', 'uses' => 'Admin@deleteTeacher']);
        });

        Route::group(['prefix' => 'student', 'as' => 'student.'], function(){
            Route::get('list-student', ['as' => 'list-student', 'uses' => 'Admin@listStudent']);
            Route::get('add-student', function(){
                return view('admin.student.add');
            })->name('admin.student.get-add-student');
            Route::post('add-student',['as' => 'post-add-student', 'uses' =>'Admin@addStudent']);
            Route::get('edit-student/{id}', ['as' => 'get-edit-student','uses' => 'Admin@editStudent']);
            Route::post('edit-student/{id}', ['as' => 'post-edit-student','uses' => 'Admin@postEditStudent']);
            Route::get('info-student/{id}', ['as' => 'info-student', 'uses' => 'Admin@infoStudent']);
            Route::delete('delete-student/{id}',['as' => 'delete-student', 'uses' => 'Admin@deleteStudent']);
            Route::post('info-student/find-avg/{id}', ['as' => 'find-avg', 'uses' => 'Admin@findAvg']);
        });

        Route::group(['prefix' => 'subject', 'as' => 'subject.'], function(){
            Route::get('list-subject', ['as' => 'list-subject', 'uses' => 'Admin@listSubject']);
            Route::get('add-subject',['as' => 'get-add-subject', function(){
                return view('admin.subjects.add');
            }]);
            Route::post('add-subject',['as' => 'post-add-subject', 'uses' =>'Admin@addSubject']);
            Route::get('edit-subject/{id}', ['as' => 'get-edit-subject','uses' => 'Admin@editSubject']);
            Route::post('edit-subject/{id}', ['as' => 'post-edit-subject','uses' => 'Admin@postEditSubject']);
            Route::delete('delete-subject/{id}',['as' => 'delete-subject', 'uses' => 'Admin@deleteSubject']);
        });

        Route::group(['prefix' => 'class', 'as' => 'class.'], function(){
            Route::get('list-class', ['as' => 'list-class', 'uses' => 'Admin@listClass']);
            Route::get('add-class', ['as' => 'get-add-class', function(){
                $subject = App\Model\Subject::all();
                return view('admin.class.add', ['subject' => $subject]);
            }]);
            Route::post('add-class',['as' => 'post-add-class', 'uses' =>'Admin@addClass']);
            Route::get('edit-class/{id}', ['as' => 'get-edit-class','uses' => 'Admin@editClass']);
            Route::post('edit-class/{id}', ['as' => 'post-edit-class','uses' => 'Admin@postEditClass']);
            Route::delete('delete-class/{id}',['as' => 'delete-class', 'uses' => 'Admin@deleteClass']);
        });
    });
});

Route::group(['namespace' => 'Student', 'prefix' => 'student', 'as' => 'student.'], function(){
   Route::group(['middleware' => 'guest'], function(){
       Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
       Route::post('login', ['as' => 'post-login', 'uses' => 'Auth\LoginController@login']);
       Route::get('verify/{token}', ['as' => 'verify', 'uses' => 'Auth\LoginController@verify']);
   });
   Route::group(['middleware' => 'student'], function(){
      Route::get('home', ['as' => 'home', function() {
          return view('student.home');
      }]);
      Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
      Route::get('class', ['as' => 'class', 'uses' => 'StudentController@classes']);
      Route::get('class/list-class', ['as' => 'class.list-class', 'uses' => 'StudentController@listClass']);
      Route::get('class/register-class/{id}', ['as' => 'class.register-class', 'uses' => 'StudentController@registerClass']);
      Route::delete('class/delete-class/{id}', ['as' => 'class.delete-class', 'uses' => 'StudentController@deleteClass']);
   });
});

Route::group(['namespace' => 'Teacher', 'prefix' => 'teacher', 'as' => 'teacher.'], function(){
    Route::group(['middleware' => 'guest'], function(){
        Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
        Route::post('login', ['as' => 'post-login', 'uses' => 'Auth\LoginController@login']);
        Route::get('verify/{token}', ['as' => 'verify', 'uses' => 'Auth\LoginController@verify']);

    });
    Route::group(['middleware' => 'teacher'], function(){
        Route::get('home', ['as' => 'home', function() {
            return view('teacher.home');
        }]);
        Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
        Route::get('class', ['as' => 'class', 'uses' => 'TeacherController@classes']);
        Route::get('class/list-class', ['as' => 'class.list-class', 'uses' => 'TeacherController@listClass']);
        Route::get('class/register-class/{id}', ['as' => 'class.register-class', 'uses' => 'TeacherController@registerClass']);
        Route::delete('class/delete-class/{id}', ['as' => 'class.delete-class', 'uses' => 'TeacherController@deleteClass']);
        Route::get('class/list-student/{id}', ['as' => 'class.list-student', 'uses' => 'TeacherController@listStudent']);
        Route::post('class/update-score/{id}/{classes_id}', ['as' => 'class.update-score', 'uses' => 'TeacherController@updateScore']);
    });
});

