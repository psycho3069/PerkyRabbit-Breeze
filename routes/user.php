<?php

use Illuminate\Support\Facades\Route;

// Route::post('/license-generate', 'App\Http\Controllers\LicenseController@generate')->name('license-generate');

Route::get('/license-form', function(){
    return view('license-form');
})->name('license-form');

Route::get('/license', function(){
    return view('license');
})->name('license');

Route::post('/get-user', 'App\Http\Controllers\LicenseController@getUser')->name('get-user');
Route::post('/get-license', 'App\Http\Controllers\LicenseController@getLicense')->name('get-license');
Route::post('/activate-license', 'App\Http\Controllers\LicenseController@activateLicense')->name('activate-license');
