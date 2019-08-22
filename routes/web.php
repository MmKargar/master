<?php

use App\User;
use Ipecompany\Smsirlaravel\Smsirlaravel;

Auth::routes();

Route::get('/', function () {
    return redirect()->route('login');
});

// Route::get('setroles' , 'FController@setroles');

Route::post('check_signup' , 'Auth\RegisterController@check_signup')->name('check_signup');
Route::post('mobexist' , 'Auth\ForgotPasswordController@mobexist')->name('mobexist');
Route::post('sendcode' , 'Auth\ForgotPasswordController@sendcode')->name('sendcode');
Route::post('confirm_code' , 'Auth\ForgotPasswordController@confirm_code')->name('confirm_code');
Route::post('sign' , 'Auth\LoginController@sign')->name('sign');
Route::get('/home', 'HomeController@index')->name('home');

Route::group([  'prefix' => 'core' , 'middleware' => [ 'web' , 'auth' , 'checkactive' ] ] , function(){
    Route::get('/' , 'DashboardController@index')->name('dashboard.index');
});

