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

Route::group(['prefix'=>'patient'], function() {
    Route::get('/landing', function () {
        return view('patient.pages.landing');
    });
    Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('show_registration');
    Route::get('/details', 'PatientDetailContoller@show')->name('show_patient_details');
    Route::post('/details', 'PatientDetailContoller@store')->name('save_patient_details');
    Route::get('/dashboard', 'MyProfileController@show')->name('show_patient_myprofile');
    Route::post('/dashboard', 'MyProfileController@update')->name('update_myprofile');
    Route::get('/dashboard/history', 'MedicalHistoryController@show')->name('show_patient_medical_history');
    Route::get('/dashboard/donation', 'DonationController@show')->name('show_donation');
    Route::get('/dashboard/settings', 'SettingsController@show')->name('show_settings');
    Route::post('/dashboard/settings', 'SettingsController@update')->name('update_settings');
});
Route::group(['prefix'=>'doctor'], function() {
    Route::get('/patients', 'Doctor\AllPatientsController@show')->name('show_doctor_page');
    Route::get('/single/{id}', 'Doctor\SinglePatientController@show')->name('show_patient');
    Route::post('/single/', 'Doctor\DiagnoseController@store')->name('save_diagnose');
    Route::get('/single/prescription/{diagnose_id}', 'Doctor\PrescriptionController@show')->name('show_prescription');
    Route::get('/search/', 'Doctor\SearchController@show')->name('search_patient');
});
Route::get('/home', 'HomeController@index')->name('home');
