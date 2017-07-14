<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

	Route::get('/login', function () {return view('login');});
	Auth::routes();
	Route::get('/logout', function() {
	    Session::flush(); 
	    return Redirect::to('/login');
	});
	Route::get('/', function () {return view('welcome');});
	Route::get('/projects/{id}', 'ProjectsController@getproject');
	Route::get('listProjectsRequest', 'ProjectsController@getprojects');

// ########################## Route Group : AI_ORG ############################ //

Route::group(['middleware' => 'AI_ORG'], function() {

	//- Documents management Routes
	Route::get('/uploadFile','documentsController@uploadFile')->name('uploadFile');
	Route::post('/uploadFile','documentsController@storeFile');
	Route::get('/viewDocuments','documentsController@viewDocuments');
	Route::get('/allDocuments','documentsController@listOfDocuments');
	Route::get('/deleteFile/{id}','documentsController@deleteFile');	      
	Route::get('/modifyDoc','documentsController@modifyDoc');


	//- Baseline management Routes
	Route::get('/newBaseline','baselineController@newBaseline');
	Route::post('/lockBaselineRequest','baselineController@lockBaseline');
	Route::post('/createBaseline','baselineController@createBaseline');
	Route::post('/updateBaseline','baselineController@updateBaseline');
	Route::get('/allBaselines','documentsController@listOfBaselines');
	



});

	Route::get('lang/{lang}', ['as'=>'lang.switch', 'uses'=>'LanguageController@switchLang']);

// ########################## Route Group : C_ORG ############################ //

Route::group(['middleware' => 'C_ORG'], function() {

	//- Projects management Routes
	Route::get('/listIntervenantsRequest', 'ProjectsController@getintervenants');
	Route::get('/getIntervenantRequest', 'ProjectsController@gettheintervenant');
	Route::post('/insertNewProject', 'ProjectsController@insertnewproject');
	Route::get('/newProject', 'ProjectsController@newprojectview');
	Route::get('/listProjects','ProjectsController@listProjects');
	Route::get('/editproject/{id}','ProjectsController@editproject');
	Route::post('/editPorjectProperties','ProjectsController@editPorjectProperties');
});

