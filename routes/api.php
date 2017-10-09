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

Route::group(['middleware' => 'cors'], function () {

// List
    Route::get('user/list','UserController@index');
    Route::get('ticket/list','TicketController@index');
    Route::get('comment/list','CommentController@index');
    Route::get('techUser/list','TechUserController@index');

// Show
    Route::get('user/{id}', 'UserController@show');
    Route::get('ticket/{id}', 'TicketController@show');
    Route::get('comment/{id}', 'CommentController@show');

// Store
    Route::post('user', 'UserController@store');
    Route::post('ticket', 'TicketController@store');
    Route::post('comment', 'CommentController@store');
    Route::post('techTicketHandler', 'TechTicketHandlerController@store');

// Update
    Route::post('user/{id}/update', 'UserController@update');
    Route::post('ticket/{id}/update', 'TicketController@update');
    Route::post('comment/{id}/update', 'CommentController@update');

// Delete
    Route::get('user/{id}/delete', 'UserController@destroy');
    Route::get('ticket/{id}/delete', 'TicketController@destroy');
    Route::get('comment/{id}/delete', 'CommentController@destroy');

//  Unique
    Route::post('techUser/findOrCreate', 'TechUserController@findOrCreate');
    Route::post('techUser/assignToTicket', 'TechUserController@assignToTicket');
    Route::get('techUser/{id}/tickets', 'TechUserController@tickets');
});
