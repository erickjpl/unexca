<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'Auth', 'prefix' => 'auth', 'middleware' => 'throttle:20,5'], function () {
	Route::post('login', 'LoginController@login');
	Route::get('/login/{service}', 'SocialLoginController@redirect');
    Route::get('/login/{service}/callback', 'SocialLoginController@callback');
    
	Route::post('logout', 'LoginController@logout')->name('logout');

	Route::post('register', 'RegisterController@register');

	Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
	Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');
	Route::post('password/confirm', 'ConfirmPasswordController@confirm');

	Route::get('email/verify/{id}/{hash}', 'VerificationController@verify')->name('verification.verify');
	Route::post('email/resend', 'VerificationController@resend')->name('verification.resend');
});


Route::get('/users', 'Profile\ProfileController@index')->name('profile.index');


Route::middleware('jwt.auth')->get('/user', function (Request $request) {
    return $request->user();
});

