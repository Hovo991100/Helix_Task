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

 Route::get('/','HomeController@index');

 Route::get('get_file','FileModificationController@getFileFromUrl');

 /**
 * Auto complete searching cities
 */
Route::get('search-cities',['as'=>'all-cities','uses'=>'CityController@SearchCities']);

Route::get('nearest-cities',['as'=>'nearest-cities','uses'=>'CityController@NearestCities']);