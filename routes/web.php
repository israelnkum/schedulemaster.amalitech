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

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::resource('users','UserController');
Route::post('/bulk_delete','UserController@bulk_delete')->name('bulk_delete');



/*
 * Candidates Routes
 */
Route::get('/all-candidates','CandidateController@all_candidate')->name('all-candidate');
Route::post('/delete_candidate','CandidateController@delete_candidate')->name('delete-candidate');
Route::post('/upload-candidates','CandidateController@import')->name('upload-candidates');

Route::get('/search-candidates','CandidateController@search_candidate')->name('search-candidate');
Route::get('/upload-format','CandidateController@downloadUploadFormat')->name('upload-format');
Route::resource('candidates','CandidateController');


//download-candidate list
Route::get('/candidate-export', 'CandidateController@export')->name('candidate-export');
/*
 * Set Emails Route
 */
Route::resource('set-emails','SetEmailController');
Route::post('/delete-emails','SetEmailController@delete_emails')->name('delete-emails');
Route::get('/send-candidate-mail','SetEmailController@send_candidate_email')->name('send-candidate-mail');


/*
 * Schedules Route
 */
Route::resource('schedules','ScheduleController');
Route::post('/delete-schedule','ScheduleController@delete_schedule')->name('delete-schedule');



/*
 * Appointment Routes
 */
Route::resource('appointment','AppointmentController');
Route::get('confirm-email','AppointmentController@confirm_email')->name('confirm-email');
Route::post('select-schedule','AppointmentController@select_schedule')->name('select-schedule');
Route::post('app-logout','AppointmentController@logout')->name('app-logout');




Route::get('/home', 'HomeController@index')->name('home');
