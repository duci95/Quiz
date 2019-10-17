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

Route::get('/entry','FrontendController@index')
    ->name('log-reg')
    ->middleware('session')
    ->fallback();
Route::get('/',function(){
    return redirect()->route('log-reg');
});
Route::get('/home/{reg?}', "FrontendController@home")->name('index');

Route::get('/logout', "LoginController@logout")->name('logout');

Route::get("/activation/{token}", "RegisterController@activation");

Route::post('/login','LoginController@login')->name('login');
Route::post("/register", "RegisterController@register")->name("register");
Route::post('/recovery', "PasswordRecoveryController@recover")->name('recovery');

Route::group(['middleware' => 'tester'] , function() {
    Route::get('/profile/{id}',"UserController@show")->name('profile-show');
    Route::get('/quiz/{id}/{category}',"QuizController@approve");
    Route::get('/test/{category}/',"QuizController@test");
    Route::post('/quiz',"QuizController@validation");
    Route::get('/quiz/{id}/{category}',"QuizController@approve");
    Route::get('/test/{category}/',"QuizController@test");
    Route::post('/quiz',"QuizController@validation");
});
Route::group(['middleware' => 'moderator'], function(){
    Route::put('/answers/trues/{answer}',"Moderator\AnswersController@updateTrues");
    Route::get('/categories/one/{category}',"Moderator\QuestionsController@showOne")->name('one');
    Route::resources([
        'categories' => 'Moderator\CategoriesController',
        'questions' => 'Moderator\QuestionsController',
        'answers' => 'Moderator\AnswersController',
        'statistics' => 'Moderator\StatisticsController'
    ]);
});

Route::group(['middleware' => 'administrator'],function(){
//    Route::resources([
//        'users' => 'UsersController'
//    ]);
});



