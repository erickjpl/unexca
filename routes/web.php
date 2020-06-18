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


Route::group(['namespace' => 'API\Auth', 'prefix' => 'auth'], function () {
	Route::get('login', 'LoginController@showLoginForm')->name('login');
	Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
	Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
	Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
	Route::get('password/confirm', 'ConfirmPasswordController@showConfirmForm')->name('password.confirm');
	Route::get('email/verify', 'VerificationController@show')->name('verification.notice');
});