<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('doctor/register','Frontend\DoctorAccountController@register');
Route::post('doctor/login','Frontend\DoctorAccountController@login');
Route::post('doctor/profile','Frontend\DoctorAccountController@profile');
Route::post('doctor/Updateprofile','Frontend\DoctorAccountController@Updateprofile');
Route::post('sendOTP','Frontend\SmsController@sendOTP');
Route::post('verifyOTP','Frontend\SmsController@verifyOTP');


