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

Route::get('/demo', 'Demo\DemoController@demo');
Route::get('/test', 'Demo\DemoController@dbTest');
Route::get('/mid', 'Demo\DemoController@mid')->middleware('activity');
Route::get('/viewDemo', 'Demo\DemoController@viewDemo');
Route::get('/demo/create', 'Demo\DemoController@create');
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
//    $ctrl = App::make("\\App\\Http\\Controllers\\" . $module . "\\" . $class . "Controller");
//    return App::call([$ctrl, $action]);
//});