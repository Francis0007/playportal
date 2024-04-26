<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploaderController;

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

////////////// Login - Logout Routes:-
Route::get('/', 'AdminController@welcome');
Auth::routes();
Route::get('/super_admin','AdminController@index')->name('super_admin')->middleware('superadmin');
Route::get('admin','AdminController@index')->name('admin')->middleware('admin');
Route::get('/logout','AdminController@logout');



Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' =>['auth']],function(){
///////////// Admin Routes:-
Route::get('/super_admin/dashboard','AdminController@index');

// Onwer Routes:
Route::match(['get','post'],'/super_admin/dashboard/upload_app', 'OwnerController@Upload_app');
Route::match(['get', 'post'], '/super_admin/dashboard/view_app', 'OwnerController@view_app');
Route::match(['get', 'post'], '/super_admin/dashboard/view_user', 'OwnerController@view_user');
Route::match(['get', 'post'], '/super_admin/dashboard/view_messages', 'OwnerController@view_messages');
Route::match(['get', 'post'], '/super_admin/dashboard/delete_app/{id}', 'OwnerController@deleteApp');
Route::get('/super_admin/dashboard/update-app-status','OwnerController@updateStatus');

// Uploader Routes:
Route::match(['get','post'],'/admin/dashboard/upload_app', 'UploaderController@Upload_app');
Route::match(['get', 'post'], '/admin/dashboard/view_app', 'UploaderController@view_app');
Route::match(['get', 'post'], '/admin/dashboard/applicationss', 'UploaderController@applicationss');
Route::get('/view_uploaded_app/{appId}', 'UploaderController@viewUploadedApp')->name('view.uploaded.app');


// Payment Routes:
Route::match(['get', 'post'], '/admin/dashboard/payment', 'UploaderController@payment');
Route::match(['get', 'post'], '/admin/dashboard/proceed_to', 'UploaderController@proceed_to');


///////////// Coachng Routes:-
Route::match(['get','post'],'/admin/dashboard','AdminController@index');
});

// Pages Route:
Route::get('/about', 'PagesController@about');
Route::get('/contact', 'PagesController@contact');
Route::get('/applications', 'PagesController@applications');
Route::get('/headapplication', 'PagesController@headapplication');

// Message Route:
Route::post('/contact-us', 'PagesController@saveContact');

//Edit Routes
Route::get('/admin/dashboard/edit_app/{id}', 'UploaderController@edit_app');
Route::post('/admin/dashboard/update_app/{id}', 'UploaderController@update_app');

//View Routes
Route::get('/admin/dashboard/my_uploaded_apps', 'UploaderController@my_uploaded_apps')->name('admin.my_uploaded_apps');

//Analytics
Route::get('/admin/analytics', 'AnalyticsController@index')->name('admin.analytics');

Route::post('/upload-zip', [UploaderController::class, 'uploadZip'])->name('upload_zip');