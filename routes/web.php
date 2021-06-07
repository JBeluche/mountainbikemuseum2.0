<?php

use Illuminate\Support\Facades\Route;

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

//Dashboard CMS Creating Mountains
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

//Redirectors
Route::get('/creating_mountains_cms_dashboard', 'DashboardController@index');


//Pages management
Route::get('/page/create', 'PagesController@create');
Route::post('/page/create', 'PagesController@store');
Route::get("/page/edit/{page}", "PagesController@edit");
Route::post('/page/edit/{page}', 'PagesController@update');
Route::get('/page/delete/{page}', 'PagesController@delete');
Route::get('/page/updatefile/{page}', 'PagesController@update');
Route::post('/page/show', 'PagesController@show');