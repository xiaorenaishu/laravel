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

Route::group(['prefix' => 'admin'], function (){
    Route::get('/student/index', 'Admin\Student\StudentController@index');
    Route::get('/student/update/{id}', 'Admin\Student\StudentController@update');
    Route::get('/student/delete/{id}', 'Admin\Student\StudentController@delete');
//    Route::match(['get', 'post'], '/student/create', ['as' => 'student_create', 'uses' => 'Admin\Student\StudentController@create']);
});
//
Route::get('/', function () {
    return view('welcome');
});
//
//Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function()
//{
//    Route::get('/', 'AdminHomeController@index');
//});
//
//Route::group(['prefix' => 'upload', 'namespace' => 'Qiniu'], function()
//{
//    Route::get('/token', 'UploadController@uptoken');
//    Route::get('/demo', 'UploadController@demo');
//    Route::get('/', function(){
//        return view('upload');
//    });
//    Route::get('/index', function(){
//        return view('upload');
//    });
//});
//
//
////Route::any('/qiniu/{class}/{action}', function($class, $action) {
////    $ctrl = \App::make("\\App\\Http\\Controllers\\Qiniu\\" . $class . "Controller");
////    return \App::call([$ctrl, $action]);
////});
//
//Route::any('/{module}/{class}/{action}/{params?}', function($module, $class, $action) {
//    $ctrl = \App::make("\\App\\Http\\Controllers\\" . $module . "\\" . $class . "Controller");
//    return \App::call([$ctrl, $action]);
//});
//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
