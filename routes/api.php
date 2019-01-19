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
//////////////////////Admin routes//////////////////////////////////////
Route::post('register','AuthController@register');
Route::post('login','AuthController@login');
Route::get('logout','AuthController@logout');

Route::middleware(['auth:api','admin'])->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Account Type Routes
    Route::resource('account-type','AccountTypeController');
    Route::post('account-type/{id}','AccountTypeController@update');
    Route::get('account-type/delete/{id}','AccountTypeController@destroy');

    // Account Routes
    Route::resource('account','AccountController');
    Route::post('account/{id}','AccountController@update');
    Route::get('account/delete/{id}','AccountController@destroy');

    // Currency Routes
    Route::resource('currency','CurrencyController');
    Route::post('currency/{id}','CurrencyController@update');
    Route::get('currency/delete/{id}','CurrencyController@destroy');

    // MoneyTransfer Routes
    Route::resource('money-transfer','MoneyTransferController');
    Route::post('money-transfer/{id}','MoneyTransferController@update');
    Route::get('money-transfer/delete/{id}','MoneyTransferController@destroy');

    // Employee Routes
    Route::resource('employee','EmployeeController');
    Route::post('employee/{id}','EmployeeController@update');
    Route::get('employee/delete/{id}','EmployeeController@destroy');

    // Client Routes
    Route::resource('client','ClientController');
    Route::post('client/{id}','ClientController@update');
    Route::get('client/delete/{id}','ClientController@destroy');

    // ProjectType Routes
    Route::resource('project-type','ProjectTypeController');
    Route::post('project-type/{id}','ProjectTypeController@update');
    Route::get('project-type/delete/{id}','ProjectTypeController@destroy');

    // Project Routes
    Route::resource('project','ProjectController');
    Route::post('project/{id}','ProjectController@update');
    Route::get('project/delete/{id}','ProjectController@destroy');

    // Finished Project Routes
    Route::resource('finished-project','FinishedProjectController');
    Route::post('finished-project/{id}','FinishedProjectController@update');
    Route::get('finished-project/delete/{id}','FinishedProjectController@destroy');

    // Employee Finished Project Routes
    Route::resource('employee-finished-project','EmployeeFinishedProjectController');
    Route::post('employee-finished-project/{id}','EmployeeFinishedProjectController@update');
    Route::get('employee-finished-project/delete/{id}','EmployeeFinishedProjectController@destroy');

    // Money Routes
    Route::resource('money','MoneyController');
    Route::post('money/{id}','MoneyController@update');
    Route::get('money/delete/{id}','MoneyController@destroy');

    // Payment Routes
    Route::resource('payment','PaymentController');
    Route::post('payment/{id}','PaymentController@update');
    Route::get('payment/delete/{id}','PaymentController@destroy');

    // Discount Routes
    Route::resource('discount','DiscountController');
    Route::post('discount/{id}','DiscountController@update');
    Route::get('discount/delete/{id}','DiscountController@destroy');



});
//////////////////////End Admin routes//////////////////////////////////////
