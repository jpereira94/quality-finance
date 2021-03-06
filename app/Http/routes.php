<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web', 'auth']], function () {

    Route::get('/', 'GlobalViewController@index');

    Route::resource('setting/account', 'AccountController', ['except' => 'show']);
    Route::resource('setting/company', 'CompanyController', ['except' => 'show']);
    Route::resource('setting/category', 'CategoryController', ['except' => 'show']);

    Route::get('transaction/pdf', 'TransactionController@generatePDF');
    Route::resource('transaction', 'TransactionController');
    Route::post('transaction/filter', 'TransactionController@filterData');

    Route::get('report', 'ReportsController@index');
    Route::get('report/raw', 'ReportsController@rawRequest');
    Route::post('report/raw', 'ReportsController@rawGet');


});

Route::group(['middleware' => ['web']], function () {
    Route::auth();
});

/*Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});*/

//Route::group(['middleware' => ''])
