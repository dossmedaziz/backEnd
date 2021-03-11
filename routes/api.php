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

            //Bills Routes
            Route::get('/getBill','BillController@getAllBills') ;
            Route::get('/getBill/{id}','BillController@getBillById') ;

            //Project Routes
            Route::get('/getProject','ProjectController@getAllProjects') ;
            Route::get('/getProject/{id}','ProjectController@getprojectById') ;

            //Paper Routes
            Route::get('/getPaper','PaperController@getAllPapers') ;
            Route::get('/getPaper/{id}','PaperController@getPaperById') ;


            //Contact Routes
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


            // User Routes
            Route::put('/updateUser/{id}','UserController@update') ;
            Route::get('/getUsers/{id}','UserController@getUserById') ;


            
            Route::post('/login','UserController@login') ;





            //Client Routes

            Route::get('/getClients','ClientController@getAllclients') ;
            Route::get('/getClients/{id}','ClientController@getClientById') ;




            //Role Routes
            Route::get('/getRoles','RoleController@getAllRoles') ;
            Route::get('/getRoles/{id}','RoleController@getRoleById') ;




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







    Route::group(['middleware' => 'auth:api'], function () {

                        // create new role by admin
                        Route::post('/createRole','RoleController@create') ;
                        Route::put('/updateRole/{id}','RoleController@update') ;
                        Route::delete('/deleteRole/{id}','RoleController@delete') ;


                        // Manage user by admin
                        Route::post('/createUser','UserController@create') ;
                        Route::get('/getUsers','UserController@getAllUsers') ;
                        Route::delete('/deleteUser/{id}','UserController@delete') ;
                        //    Route::get('/test','UserController@test');


                        // Manage Client by admin
                        Route::post('/createClient','ClientController@create') ;
                        Route::put('/updateClient/{id}','ClientController@update') ;
                        Route::delete('/deleteClient/{id}','ClientController@delete') ;
                        Route::get('/getUclients/{id}','ClientController@getUserClients') ;

                        Route::get('/projectClient/{id}', 'ClientController@projectClient');
                        Route::get('/getClientContact/{id}', 'ClientController@getClientContact');


                        //Manage Projects by admin
                        Route::post('/createProject','ProjectController@create') ;
                        Route::put('/updateProject/{id}','ProjectController@update') ;
                        Route::delete('/deleteProject/{id}','ProjectController@delete') ;
                        Route::get('/getUserProjects/{id}','ProjectController@getUserProjects') ;

                        Route::get('/paperProject/{id}', 'ProjectController@paperProject');

                        //Create  Bill By admin
                        Route::post('/createBill','BillController@create') ;
                        Route::put('/updateBill/{id}','BillController@update') ;
                        Route::delete('/deleteBill/{id}','BillController@delete') ;


                        //manage paper by admin
                        Route::post('/createPaper','PaperController@create') ;
                        Route::put('/updatePaper/{id}','PaperController@update') ;
                        Route::delete('/deletePaper/{id}','PaperController@delete') ;
                        Route::get('getTypeofThePaper/{id}','PaperController@getTypeofThePaper');


                        // Get all activity log by admin
                            Route::get('/getActivities','ActivityLogController@activities');
                            Route::get('/getActivities/{id}','ActivityLogController@userActivities');



                        // manage paper type
                            Route::post('/createType','PaperTypeController@create') ;
                            Route::put('/updateType/{id}','PaperTypeController@update') ;
                            Route::get('/getType','PaperTypeController@getAllpaperTypes') ;
                            Route::get('/getType/{id}','PaperTypeController@getpaperTypeById') ;
                            Route::delete('/deleteType/{id}','PaperTypeController@delete') ;
                            Route::get('getPaperofTheType/{id}','PaperTypeController@getPaperofTheType');

                            //Manage contacts by admin
                            Route::post('/createContact','ContactController@create') ;




                            // manage item
                            Route::post('/createItem','ItemController@create') ;
                            Route::put('/updateItem/{id}','ItemController@update') ;
                            Route::get('/getItems','ItemController@getAllpaperTypes') ;
                            Route::get('/getItems/{id}','ItemController@getpaperTypeById') ;
                            Route::delete('/deleteItem/{id}','ItemController@delete') ;






    });

Route::get('/test/{id}','BillController@test');
Route::get('/test1/{id}','ClientController@test1');
