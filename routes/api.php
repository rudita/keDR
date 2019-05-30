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

// Route::post('login','ApiLogController@login');

//http://local-api.yumbox.id:9090/public/account/login

// $api->post('account/register', [
//     'uses' => 'App\Http\Controllers\Frontend\DoctorAccountController@register'
// ]);


Route::post('login','Frontend\DoctorAccountController@login');



