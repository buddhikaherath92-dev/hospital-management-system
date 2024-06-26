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
    Route::post('/dashboard', 'MyProfileController@updatePersonalData')->name('update_myprofile');
    Route::get('/dashboard/history', 'MedicalHistoryController@show')->name('show_patient_medical_history');
    Route::get('/dashboard/donation', 'DonationController@show')->name('show_donation');
    Route::post('/dashboard/donation', 'DonationController@store')->name('store_donation');
    Route::get('/dashboard/settings', 'SettingsController@show')->name('show_settings');
    Route::post('/dashboard/settings', 'SettingsController@update')->name('update_settings');
    Route::get('/single/{id}', 'SingleDiagnoseController@show')->name('show_single_diagnose');
    Route::post('/attach_report', 'PatientReportController@store')->name('attach_report');
    Route::get('/completed_request/download/{report_id}', 'PatientReportController@download')->name('download_patient_report');
    Route::get('/completed_request/doctor_report_download/{report_id}', 'PatientReportController@downloadDoctorReport')
        ->name('doctor_report_download');
    Route::post('/emergency', 'EmergencyDetailsController@store')->name('emergency');
    Route::get('/dashboard/all_donations', 'DonationController@showDonations')->name('get_all_donations');
    Route::get('/dashboard/all_requests', 'DonationController@showRequests')->name('get_all_requests');
    Route::get('/getPDF/{id}', 'PDFController@getPDF');
    Route::post('/add_event', 'Doctor\EventController@store')->name('add_event');
    Route::get('/reports/hba1c', 'Hba1cReportController@show')->name('show_hba1c_report');
    Route::get('/reports/bp', 'BloodPressureReportController@show')->name('show_bp_report');
    Route::get('/reports/cholesterol', 'CholesterolReportController@show')->name('show_cholesterol_report');
});
Route::group(['prefix'=>'doctor'], function() {
    Route::get('/patients', 'Doctor\AllPatientsController@show')->name('show_doctor_page');
    Route::get('/single/{id}', 'Doctor\SinglePatientController@show')->name('show_patient');
    Route::post('/single/', 'Doctor\DiagnoseController@store')->name('save_diagnose');
    Route::get('/single/prescription/{diagnose_id}', 'Doctor\PrescriptionController@show')->name('show_prescription');
    Route::get('/search/', 'Doctor\SearchController@show')->name('search_patient');
    Route::post('/lab/', 'Doctor\LabReportController@store')->name('request_report');
    Route::get('/all_donations', 'Doctor\AllDonationsController@show')->name('show_all_donations_page');
    Route::get('/all_users', 'Doctor\NewDoctorController@show')->name('show_all_users');
    Route::post('/add_users', 'Doctor\NewDoctorController@store')->name('add_doctors');
    Route::get('/all_appoinments', 'Nurse\AppoinmentController@show')->name('show_all_appoinments');
    Route::post('/filter', 'Nurse\AppoinmentController@filter')->name('filter_appoinments');
});
Route::group(['prefix'=>'lab'], function() {
    Route::get('/request', 'Lab\RequestController@show')->name('show_requests');
    Route::get('/single_request/{report_id}', 'Lab\SingleRequestController@show')->name('show_request');
    Route::post('/single_request/', 'Lab\SingleRequestController@update')->name('ready_request');
    Route::get('/completed_request/{report_id}', 'Lab\CompletedRequestsController@show')->name('completed_request');
    Route::get('/completed_request/download/{report_id}', 'Lab\CompletedRequestsController@download')->name('download_report');
    Route::get('/all_users', 'Lab\NewLabController@show')->name('show_all_lab');
    Route::post('/add_users', 'Lab\NewLabController@store')->name('add_labuser');
});
Route::group(['prefix'=>'pharmacy'], function() {
    Route::get('/prescriptions', 'Pharmacy\AllPrescriptionController@show')->name('show_all_prescriptions');
    Route::get('/single/{id}', 'Pharmacy\SinglePatientPrescriptionController@show')->name('show_single_prescriptions');
    Route::post('/single/', 'Pharmacy\SinglePatientPrescriptionController@update')->name('update_prescription');
    Route::get('/all_users', 'Pharmacy\NewPharmacyController@show')->name('show_all_pharmacy');
    Route::post('/add_users', 'Pharmacy\NewPharmacyController@store')->name('add_pharmacy');
});

Route::group(['prefix'=>'nurse'], function() {
    Route::get('/dashboard', 'Nurse\NurseDashboardController@show')->name('show_nurse_dashboard');
    Route::get('/make_appointment', 'Nurse\MakeAppointmentController@show')->name('show_make_appointment');
    Route::post('/make_appoinment', 'Nurse\MakeAppointmentController@store')->name('make_appoinment');
    Route::post('/make_appoinment_unregistered', 'Nurse\AppoinmentController@storeUnregisterd')
        ->name('make_appoinment_unregistered');
    Route::get('/all_users', 'Nurse\NewNurseController@show')->name('show_all_nurse');
    Route::post('/add_users', 'Nurse\NewNurseController@store')->name('add_nurse');
});

Route::group(['prefix'=>'admin'], function() {
    Route::get('/dashboard', 'Admin\AdminController@show')->name('show_admin_dashboard');
    Route::post('/add_new_user', 'Admin\AdminController@store')->name('add_new_user');
    Route::post('/search_user', 'Admin\AdminController@index')->name('search_user');
    Route::get('/remove_user/{id}', 'Admin\AdminController@delete');
});

Route::get('/home', 'HomeController@index')->name('home');
