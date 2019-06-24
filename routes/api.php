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

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->group(['prefix' => 'doctor'], function ($api) {
        $api->POST('register',  'App\Http\Controllers\Api\DoctorAccountController@register');
        $api->POST('login',  'App\Http\Controllers\Api\DoctorAccountController@login');  
        $api->POST('profile',  'App\Http\Controllers\Api\DoctorAccountController@profile');
        $api->POST('Updateprofile',  'App\Http\Controllers\Api\DoctorAccountController@Updateprofile');        
        $api->POST('logout',  'App\Http\Controllers\Api\DoctorAccountController@logout');    
        $api->POST('forgotPassword',  'App\Http\Controllers\Api\OTPController@forgotPassword');    
        $api->POST('verifyOTP',  'App\Http\Controllers\Api\OTPController@verifyOTP');   
        
        $api->POST('createSchedule',  'App\Http\Controllers\Api\DoctorScheduleController@create');  
        $api->POST('SubmitQueue',  'App\Http\Controllers\Api\PatientBookingRequestController@SubmitQueue');
        
        $api->GET('getHistorySchedule',  'App\Http\Controllers\Api\DoctorScheduleDetailController@getHistorySchedule');
        $api->GET('getSchedule',  'App\Http\Controllers\Api\DoctorScheduleDetailController@getSchedule');
    });
    
    $api->group(['prefix' => 'patient'], function ($api) {
        $api->POST('register',  'App\Http\Controllers\Api\PatientAccountController@register');
        $api->POST('login',  'App\Http\Controllers\Api\PatientAccountController@login');  
        $api->POST('profile',  'App\Http\Controllers\Api\PatientAccountController@profile');
        $api->POST('Updateprofile',  'App\Http\Controllers\Api\PatientAccountController@Updateprofile');   
        $api->POST('logout',  'App\Http\Controllers\Api\PatientAccountController@logout');          
        $api->POST('forgotPassword',  'App\Http\Controllers\Api\OTPController@forgotPassword');
        $api->POST('verifyOTP',  'App\Http\Controllers\Api\OTPController@verifyOTP');    

        $api->GET('Banner', 'App\Http\Controllers\Api\BannerPromotionController@index');
        $api->GET('getBannerById', 'App\Http\Controllers\Api\BannerPromotionController@getBannerById');

        $api->GET('Specialist', 'App\Http\Controllers\Api\DoctorSpecialistController@index');     

        $api->GET('Doctor', 'App\Http\Controllers\Api\GetDoctorController@index');   
        $api->GET('getDoctorById', 'App\Http\Controllers\Api\GetDoctorController@getDoctorById'); 
        $api->GET('getDoctorByName', 'App\Http\Controllers\Api\GetDoctorController@getDoctorByName');    
        $api->GET('getDoctorBySpecialistId', 'App\Http\Controllers\Api\GetDoctorController@getDoctorBySpecialistId');
        $api->GET('getDoctorBySpecialistIdAndName', 'App\Http\Controllers\Api\GetDoctorController@getDoctorBySpecialistIdAndName');        
        $api->GET('getDoctorByLocation', 'App\Http\Controllers\Api\GetDoctorController@getDoctorByLocation');                     

        $api->GET('getDetailDoctor', 'App\Http\Controllers\Api\GetDoctorController@getDetailDoctor'); 
        $api->GET('getDoctorSchedule', 'App\Http\Controllers\Api\GetDoctorController@getDoctorSchedule');  

        $api->POST('Booking',  'App\Http\Controllers\Api\PatientBookingRequestController@Booking');


    });

    

});

