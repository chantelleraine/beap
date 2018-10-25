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
Route::get('/dashboard', 'PagesController@dashboard');

Route::get('/reports', 'PagesController@reports');

Route::resource('/calamityposts', 'CalamitiesController');
Auth::routes();

Route::resource('/illustrationposts', 'IllustrationsController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('director/login','DirectorAuth\DirectorLoginController@showLoginForm')->name('director.login');
Route::post('director/login','DirectorAuth\DirectorLoginController@login')->name('director.login.submit');
Route::post('director/logout','DirectorAuth\DirectorLoginController@directorLogout')->name('director.logout');

Route::get('director/', 'DirectorController@index')->name('director.dashboard');