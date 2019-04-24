<?php
use App\Child;
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

Route::group(['middleware' => ['web']], function () {

    Route::prefix("/register")->group(function (){
        Route::get('/','Auth\RegisterController@showEmailForm')->name('register.email_form');
        Route::post('/','Auth\RegisterController@saveEmail')->name('register.save_email');
        Route::get('/kinder/{code}','Auth\RegisterController@showRegisterForm')->name('register.form');
        Route::post('/kinder/confirmation','Auth\RegisterController@confirmRegisterForm')->name('register.confirm_form');
        Route::post('/kinder/complete','Auth\RegisterController@saveRegisterForm')->name('register.save_form');
    });


});

