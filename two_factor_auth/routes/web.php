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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('confirm', function(){

    return view('confirm');

});

Route::get('two_factor_auth/login_form', 'TwoFactorAuthController@login_form');
Route::post('ajax/two_factor_auth/first_auth', 'TwoFactorAuthController@first_auth');
Route::post('ajax/two_factor_auth/second_auth', 'TwoFactorAuthController@second_auth');
