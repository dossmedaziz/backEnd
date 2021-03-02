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

//Bills Routes
Route::post('/createBill','BillController@create') ;
Route::put('/updateBill/{id}','BillController@update') ;
Route::get('/getBill','BillController@getAllBills') ;
Route::get('/getBill/{id}','BillController@getBillById') ;
Route::delete('/deleteBill/{id}','BillController@delete') ;

//Project Routes
Route::post('/createProject','ProjectController@create') ;
Route::put('/updateProject/{id}','ProjectController@update') ;
Route::get('/getProject','ProjectController@getAllProjects') ;
Route::get('/getProject/{id}','ProjectController@getprojectById') ;
Route::delete('/deleteProject/{id}','ProjectController@delete') ;

//Paper Routes
Route::post('/createPaper','PaperController@create') ;
Route::put('/updatePaper/{id}','PaperController@update') ;
Route::get('/getPaper','PaperController@getAllPapers') ;
Route::get('/getPaper/{id}','PaperController@getPaperById') ;
Route::delete('/deletePaper/{id}','PaperController@delete') ;

//Contact Routes
Route::post('/createContact','ContactController@create') ;
Route::put('/updateContact/{id}','ContactController@update') ;
Route::get('/getContact','ContactController@getAllContact') ;
Route::get('/getContact/{id}','ContactController@getContactById') ;
Route::delete('/deleteContact/{id}','ContactController@delete') ;

//MailContent Routes
Route::post('/createMailContent','MailContentController@create') ;
Route::put('/updateMailContent/{id}','MailContentController@update') ;
Route::get('/getMailContent','MailContentController@getAllMailContents') ;
Route::get('/getMailContent/{id}','MailContentController@getMailContentById') ;
Route::delete('/deleteMailContent/{id}','MailContentController@delete') ;

//Type Routes
Route::post('/createType','PaperTypeController@create') ;
Route::put('/updateType/{id}','PaperTypeController@update') ;
Route::get('/getType','PaperTypeController@getAllpaperTypes') ;
Route::get('/getType/{id}','PaperTypeController@getpaperTypeById') ;
Route::delete('/deleteType/{id}','PaperTypeController@delete') ;
