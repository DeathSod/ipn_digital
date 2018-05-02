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

Route::get('/', 'PagesController@index');
Route::post('/people', 'PeopleController@store');
Route::post('/companies', 'CompaniesController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/settings', 'HomeController@settings');
