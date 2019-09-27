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

Route::get('/','FrontendController@index');
Route::post('/login','LoginController@login')->name('login');
Route::post("/register", "RegisterController@register")->name("register");
Route::get("/activation/{token}", "RegisterController@activation");
Route::post('/recovery', "PasswordRecoveryController@recover")->name('recovery');