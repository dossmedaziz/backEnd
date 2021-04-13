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
            Route::get('/getBill/{id}','BillController@getBillById') ;

            //Project Routes
            Route::get('/getProject/{id}','ProjectController@getprojectById') ;

            //Paper Routes
            Route::get('/getPaper/{id}','PaperController@getPaperById') ;


            //Contact Routes
            Route::get('/getContact','ContactController@getAllContact') ;
            Route::get('/getContact/{id}','ContactController@getContactById') ;

            //MailContent Routes
            Route::post('/createMailContent','MailContentController@create') ;
            Route::put('/updateMailContent/{id}','MailContentController@update') ;
            Route::get('/getMailContent','MailContentController@getAllMailContents') ;
            Route::get('/getMailContent/{id}','MailContentController@getMailContentById') ;
            Route::delete('/deleteMailContent/{id}','MailContentController@delete') ;

            //Type Routes


            // User Routes
            Route::get('/getUsers/{id}','UserController@getUserById') ;



            Route::post('/login','UserController@login') ;





            //Client Routes

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











Route::group(['middleware' => 'auth:api'], function () {

                        // Manage role by admin
                        Route::post('/createRole','RoleController@create') ;
                        Route::put('/updateRole/{id}','RoleController@update') ;
                        Route::post('/deleteRole','RoleController@delete') ;
                        Route::get('/getRoleprivileges/{id}','RoleController@getRoleprivileges') ;


                        // Manage user by admin
                        Route::post('/createUser','UserController@create') ;
                        Route::get('/getUsers','UserController@getAllUsers') ;
                        Route::post('/deleteUser','UserController@delete') ;
                        Route::put('/updateUser/{id}','UserController@update') ;

                        //    Route::get('/test','UserController@test');


                        // Manage Client by admin
                        Route::post('/createClient','ClientController@create') ;
                        Route::put('/updateClient/{id}','ClientController@update') ;
                        Route::post('/deleteClient','ClientController@delete') ;
                        Route::get('/getClients','ClientController@getAllclients') ;
                        Route::get('/getUclients/{id}','ClientController@getUserClients') ;
                        Route::get('/ClientsWithProjects', 'ClientController@ClientsWithProjects');
                        Route::get('/projectClient/{id}', 'ClientController@projectClient');
                        Route::get('/getClientContact/{id}', 'ClientController@getClientContact');


                        //Manage Projects by admin
                        Route::post('/createProject','ProjectController@create') ;
                        Route::put('/updateProject','ProjectController@update') ;
                        Route::post('/deleteProject','ProjectController@delete') ;
                        Route::get('/getUserProjects/{id}','ProjectController@getUserProjects') ;
                        Route::get('/getProjects','ProjectController@getAllProjects') ;
                        Route::get('/paperProject/{id}', 'ProjectController@paperProject');

                        //Create  Bill By admin
                        Route::post('/createBill','BillController@create') ;
                        Route::put('/updateBill/{id}','BillController@update') ;
                        Route::get('/getBill','BillController@getAllBills') ;
                        Route::post('/deleteBill','BillController@delete') ;


                        //manage paper by admin
                        Route::post('/createPaper','PaperController@create') ;
                        Route::put('/updatePaper','PaperController@update') ;
                        Route::post('/deletePaper','PaperController@delete') ;
                        Route::get('getTypeofThePaper/{id}','PaperController@getTypeofThePaper');
                        Route::post('uploadFile','PaperController@uploadFile');

                        Route::get('getProjectsWithinfo','ProjectController@getProjectsWithinfo');


                        // Get all activity log by admin
                            Route::get('/getActivities','ActivityLogController@activities');
                            Route::get('/getActivities/{id}','ActivityLogController@userActivities');



                        // manage paper type
                            Route::post('/createType','PaperTypeController@create') ;
                            Route::put('/updateType','PaperTypeController@update') ;
                            Route::get('/getPaperTypes','PaperTypeController@getAllpaperTypes') ;
                            Route::get('/getType/{id}','PaperTypeController@getpaperTypeById') ;
                            Route::post('/deleteType','PaperTypeController@delete') ;
                            Route::get('/getPapers','PaperController@getAllPapers') ;
                            Route::get('getPaperofTheType/{id}','PaperTypeController@getPaperofTheType');



                            //Manage contacts by admin
                            Route::post('/createContact','ContactController@create') ;
                            Route::get('/clientWithContacts','ClientController@clientWithContacts');
                            Route::put('/updateContact','ContactController@update') ;
                            Route::post('/deleteContact','ContactController@delete') ;




                            //Manage Company
                            Route::get('/getCompanyInfo','CompanyController@getCompanyInfo') ;
                            Route::put('/updateCompany/{id}','CompanyController@update') ;

                            // manage item
                            Route::post('/createItem','ItemController@create') ;
                            Route::put('/updateItem/{id}','ItemController@update') ;
                            Route::get('/getItems','ItemController@getAllpaperTypes') ;
                            Route::get('/getItems/{id}','ItemController@getpaperTypeById') ;
                            Route::delete('/deleteItem/{id}','ItemController@delete') ;



                        //Manage actions
                             Route::get('/getActions','ActionController@getActions');


                        // Manage spaces
                             Route::get('/getSpaces','SpaceController@getSpaces');


                            // get just contracts
                        Route::get('/getJustContracts','PaperController@getJustContracts');


                        // sending mail api
                        Route::post('/sendMail','PaperController@sendMail');
                            });

