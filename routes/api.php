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
Route::prefix('v1')->namespace('API')->group(function () {
    // Login
    Route::post('/login','AuthController@postLogin');
    // Protected with APIToken Middleware
    Route::middleware('APIToken')->group(function () {
        // Logout
        Route::post('/logout','AuthController@postLogout');
        // Employee
        Route::resource('/employee', 'EmployeeController');
        // Company
        Route::resource('/company', 'CompanyController');
        // List Companies
        Route::get('/mycompanies', 'UserController@showCompanies');
        // List Users
        Route::get('/user', 'UserController@index');
    });
  });
