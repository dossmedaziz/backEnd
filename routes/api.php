<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



// User Routes
Route::post('/createUser','UserController@create') ; 
Route::put('/updateUser/{id}','UserController@update') ; 
Route::get('/getUsers','UserController@getAllUsers') ; 
Route::get('/getUsers/{id}','UserController@getUserById') ; 
Route::delete('/deleteUser/{id}','UserController@delete') ; 


//Client Routes
Route::post('/createClient','ClientController@create') ;
Route::put('/updateClient/{id}','ClientController@update') ;
Route::get('/getClients','ClientController@getAllclients') ;
Route::get('/getClients/{id}','ClientController@getClientById') ;
Route::delete('/deleteClient/{id}','ClientController@delete') ;