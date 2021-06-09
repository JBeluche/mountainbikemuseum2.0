<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CMSCreatingMountainsController;
use App\Http\Controllers\NavbarItemController;
use App\Http\Controllers\PagesController;

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

//Redirectors


//Dashboard CMS Creating Mountains
Route::get('CMS_CreatingMountains', [CMSCreatingMountainsController::class, 'index']);
//Route::get('/dashboard', 'DashboardController@index')->name('dashboard');


Route::resource('pages', PagesController::class);
Route::resource('navbaritem', NavbarItemController::class);

/*
//Pages management
Route::get('/page/create', 'PagesController@create');
Route::post('/page/create', 'PagesController@store');
Route::get("/page/edit/{page}", "PagesController@edit");
Route::post('/page/edit/{page}', 'PagesController@update');
Route::get('/page/delete/{page}', 'PagesController@delete');
Route::get('/page/updatefile/{page}', 'PagesController@update');
Route::post('/page/show', 'PagesController@show');*/