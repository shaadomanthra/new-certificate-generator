<?php

use Illuminate\Support\Facades\Route;


// Authentication
Auth::routes();

// Route for Index Page
Route::get('/','rootController@index');

// ROute for dashboard
Route::get('/dashboard','dashboardController@dashboard');

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

Route::get("/dashboard/template_2", "dashboardController@template_2");

// Routes for Certificate view
Route::get('/{verification_id}','rootController@show_certificate');

// Route to download certificate
Route::post("/download_certificate", 'rootController@download_certificate');

