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

Route::group(['prefix'=>'patient'], function(){
    Route::get('/landing', function () {
        return view('patient.pages.landing');
    });
    Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('show_registration');
    Route::get('/details', 'PatientDetailContoller@show')->name('show_patient_details');
    Route::post('/details', 'PatientDetailContoller@store')->name('save_patient_details');
    Route::get('/dashboard', function (){
        return view('patient.pages.dashboard');
    })->name('show_patient_dashboard');
});

Route::get('/home', 'HomeController@index')->name('home');
