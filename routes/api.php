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
	Route::post('login', 'LoginController@login')->name('login');
	Route::get('login/{service}', 'SocialLoginController@redirect');
    Route::get('login/{service}/callback', 'SocialLoginController@callback');
    
	Route::post('logout', 'LoginController@logout')->name('logout')->middleware('jwt.verify');

	Route::post('register', 'RegisterController@register')->name('register');

	Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
	Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');
	Route::post('password/confirm', 'ConfirmPasswordController@confirm');

	Route::get('email/verify/{id}/{hash}', 'VerificationController@verify')->name('verification.verify')->middleware('jwt.verify');
	Route::post('email/resend', 'VerificationController@resend')->name('verification.resend');
});

Route::group(['middleware' => ['verified','jwt.verify']], function() {
	Route::group(['namespace' => 'Profile', 'prefix' => 'profile'], function () {
		Route::put('user/{user}', 'ProfileController@user')->name('profile.update.user');
		Route::put('detail/{user}', 'ProfileController@detail')->name('profile.update.detail');
		Route::put('user/password/{user}', 'ProfileController@password')->name('profile.update.password');
	});
});


Route::get('users', 'Profile\ProfileController@index')->name('profile.index');
Route::get('users/{user}', 'Profile\ProfileController@show')->name('profile.show');

Route::delete('student/{student}', 'Profile\ProfileController@destroy')->name('student.delete');


Route::middleware('jwt.auth')->get('/user', function (Request $request) {
    return $request->user();
});

