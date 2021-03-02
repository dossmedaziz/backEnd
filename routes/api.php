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




            //Role Routes
            Route::post('/createRole','RoleController@create') ;
            Route::put('/updateRole/{id}','RoleController@update') ;
            Route::get('/getRoles','RoleController@getAllRoles') ;
            Route::get('/getRoles/{id}','RoleController@getRoleById') ;
            Route::delete('/deleteRole/{id}','RoleController@delete') ;




            //Privilege Routes
            Route::post('/createPrivilege','PrivilegeController@create') ;
            Route::put('/updatePrivilege/{id}','PrivilegeController@update') ;
            Route::get('/getPrivileges','PrivilegeController@getAllPrivileges') ;
            Route::get('/getPrivileges/{id}','PrivilegeController@getPrivilegeById') ;
            Route::delete('/deletePrivilege/{id}','PrivilegeController@delete') ;




            
            //Company Routes
            Route::post('/createCompany','CompanyController@create') ;
            Route::put('/updateCompany/{id}','CompanyController@update') ;
            Route::get('/getCompanyInfo','CompanyController@getCompanyInfo') ;
