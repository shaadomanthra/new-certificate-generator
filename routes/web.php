<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;


// Authentication
Auth::routes(['verify' => true]);

// Route for Index Page
Route::get('/','rootController@index');

// ROute for dashboard
Route::get('/dashboard','dashboardController@dashboard')->middleware('verified');

Route::get('/dashboard/zipMail','dashboardController@zipMail');
Route::get('/dashboard/zipFiles/{session_key}','dashboardController@zipFiles');
Route::post('/dashboard/downloadZip','dashboardController@downloadZip');

// Routes for templates
Route::get('/dashboard/templates', 'dashboardController@templates');
Route::post('/dashboard/edit_default_template', 'dashboardController@edit_default_template');
Route::post('/dashboard/create_template', 'dashboardController@create_template');

// Routes for uploads
Route::get('/dashboard/upload','dashboardController@upload');
Route::post('/dashboard/upload_font', 'dashboardController@upload_font');
Route::post('/dashboard/upload_certificate_details', 'dashboardController@upload_certificate_details');
Route::post('/dashboard/upload_logo', 'dashboardController@upload_logo');
Route::post('/dashboard/upload_sign', 'dashboardController@upload_sign');

// Routes for database
Route::get('/dashboard/database','dashboardController@database');
Route::post('/dashboard/database/search','dashboardController@search');
Route::post('/dashboard/edit_record/{verification_id}','dashboardController@edit_record');
Route::post('/dashboard/delete_record/{verification_id}','dashboardController@delete_record');

// Routes for download
Route::get('/dashboard/downloadCsv','dashboardController@downloadCsv');

// Route for files
Route::get('/dashboard/files', 'dashboardController@files');
Route::post('/dashboard/files/delete_file', 'dashboardController@delete_file');
Route::post('/dashboard/files/view_delete_template', 'dashboardController@view_delete_template');

// Bulk Download Images
Route::post("/dashboard/bulkDownload", "dashboardController@bulkDownload");

Route::get("/dashboard/template_3", "dashboardController@template_3");

// Routes for Certificate view
Route::get('/{verification_id}','rootController@show_certificate');

// Route to download certificate
Route::post("/download_certificate", 'rootController@download_certificate');

