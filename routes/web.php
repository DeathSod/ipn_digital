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

//Auth routes
Auth::routes();

//Index routers (no login)
Route::get('/', 'PagesController@index');
Route::post('/people', 'PeopleController@store');
Route::post('/companies', 'CompaniesController@store');

//User


//People


//Home routees (logged in)
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/settings', 'HomeController@settings');
Route::get('/home/portals', 'HomeController@portals');
Route::get('/home/portals/{companies}', 'HomeController@companies');
Route::post('/home/forecast', 'HomeController@forecast');

//Payments
Route::get('/home/payments', 'PaymentsController@index');

//Admin
Route::get('/admin', 'AdminController@admin')
    ->middleware('is_admin')
    ->name('admin');