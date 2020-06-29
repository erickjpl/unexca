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
	Route::get('login', 'LoginController@showLoginForm');
	Route::get('register', 'RegisterController@showRegistrationForm');
	Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm');
	Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm');
	Route::get('password/confirm', 'ConfirmPasswordController@showConfirmForm');
	Route::get('email/verify', 'VerificationController@show');
});