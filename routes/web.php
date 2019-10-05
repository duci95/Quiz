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


use Illuminate\Support\Facades\Route;

Route::get('/entry','FrontendController@index')->name('log-reg');
Route::get('/{reg?}/', "FrontendController@home")->name('index')->fallback();
Route::get('/logout', "LoginController@logout")->name('logout');

Route::get('/quiz/{id}/{category}',"QuizController@approve");
Route::get('/test/{category}','QuizController@test')->name('test');

Route::get('/quiz/{category}', "CategoryController@index")->name('quiz');

Route::get("/activation/{token}", "RegisterController@activation");

Route::post('/login','LoginController@login')->name('login');
Route::post("/register", "RegisterController@register")->name("register");
Route::post('/recovery', "PasswordRecoveryController@recover")->name('recovery');

Route::get('/profile/{id}',"UserController@show")->name('profile-show');
