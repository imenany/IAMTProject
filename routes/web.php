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
	Route::get('/', function () {

        Session::forget('role');
        Session::forget('currentProject');
		if(Auth::user()->access == 0)
			return view('welcome');
		else return view('Admin_layouts.adminContent');
	});

// ########################## Route Group : Users ############################ //



Route::group(['middleware' => 'otherUsers'], function() {

	Route::group(['middleware' => 'LeadAssessorAndAssessor'], function() {
		//- Findings management Routes
		Route::post('/addFinding','FindingsController@getAddFindingView');
		Route::post('/savefindingRequest','FindingsController@addNewFinding');

		Route::post('/modifyFinding','FindingsController@getModifiyFindingView');
		Route::post('/modifiedFindings','FindingsController@getModifiedFindingsView');

		//- Document 
		Route::post('/uploadDocument','documentsController@uploadFile');
		
	});


	Route::group(['middleware' => 'manager'], function() {
			//- Baseline management Routes
		Route::post('/newBaseline','baselineController@newBaseline');
		Route::post('/lockBaselineRequest','baselineController@lockBaseline');
		
		Route::post('/createBaseline','baselineController@createBaseline');
		Route::post('/updateBaseline','baselineController@updateBaseline');
		
		Route::post('/validateDocument','documentsController@validateDocument');
		Route::post('/rejectDocument','documentsController@rejectDocument');
		
		Route::post('/getdocsnotifications','documentsController@countInvalidDocs');
		Route::get('/validateDocs','documentsController@getDocumentsToValidate');
		
		Route::post('/opencloseBaseline','baselineController@getOpenCloseBaselineView');
		Route::post('/openBaselineRequest','baselineController@openBaselineRequest');
		Route::post('/closeBaselineRequest','baselineController@closeBaselineRequest');

		Route::post('/lockBaseline','baselineController@getLockBaselineView');

	});

	Route::group(['middleware' => 'PparticipantAndManager'], function() {
			//- Documents management Routes
		Route::post('/uploadFile','documentsController@uploadFile')->name('uploadFile');
		Route::post('/storeFile','documentsController@storeFile');
		Route::get('/deleteFile/{id}','documentsController@deleteFile');	      
		Route::get('/modifyDoc','documentsController@modifyDoc');
		Route::get('/editDocument','documentsController@editDocument');
		Route::post('/saveEditionDoc','documentsController@saveEditionDoc');

	});


	/* ********* Project Phases Management ****************/
	Route::post('/projectPhases','ProjectsController@getProjectPhasesView');
	Route::post('/changePhasesRequest','ProjectsController@changePhases');

	/* ********* Project Participants Management ****************/
	Route::post('/projectParticipants','ProjectsController@getProjectParticipantsView');
	Route::post('/changeProjectParticipants','ProjectsController@changeParticipants');
	Route::get('/listProjectIntervenantsRequest', 'ProjectsController@getProjectintervenants');
	Route::get('/getProjectIntervenantRequest', 'ProjectsController@gettheintervenant');

	/* ********* Project Documents Accessibility ****************/
	Route::post('/documentsAccessibility','ProjectsController@geDocumentsAccessibilityView');


	/*********** Findings Routes ****************/
	Route::post('/allFindings','FindingsController@getAllFindingsView');
	Route::get('/getFindingData','FindingsController@getFindingData');
	Route::post('/saveFindingResponse','FindingsController@saveFindingResponse');
	Route::post('/displayFinding','FindingsController@getDisplayFindingView');
	Route::post('/saveFindingResponseA','FindingsController@saveFindingResponseA');
	Route::post('/saveFindingModification','FindingsController@saveFindingModification');

	/*********** ROBS Routes ****************/
	Route::post('/generateROBSView','FindingsController@getGenerateROBSView');
	Route::get('/generateROBSPDF','FindingsController@generateROBSPDF');
	Route::get('/generateROBSXLS','FindingsController@generateROBSXLS');
	Route::post('/downloadROBS','FindingsController@generateROBS');

	/*********** CHAT Routes ****************/
	Route::get('/listProjectMessages','ProjectsController@getMessages');
	Route::get('/addMessage','ProjectsController@addMessage');


	
	Route::post('/allBaselines','baselineController@listOfBaselines');
	Route::get('listProjectsRequest', 'ProjectsController@getprojects');
	Route::post('/viewDocuments','documentsController@viewDocuments');
	Route::post('/allDocuments','documentsController@listOfDocuments');
	Route::get('/projects/{id}', 'ProjectsController@getproject');
	
});

	Route::get('lang/{lang}', ['as'=>'lang.switch', 'uses'=>'LanguageController@switchLang']);

// ########################## Route Group : Admin ############################ //

Route::group(['middleware' => 'Admin'], function() {

	//- Projects management Routes
	Route::get('/listIntervenantsRequest', 'ProjectsController@getintervenants');
	Route::get('/getIntervenantRequest', 'ProjectsController@gettheintervenant');
	Route::post('/insertNewProject', 'ProjectsController@insertnewproject');
	Route::get('/newProject', 'ProjectsController@newprojectview');
	Route::get('/listProjects','ProjectsController@listProjects');
	Route::get('/editproject/{id}','ProjectsController@editproject');
	Route::post('/editPorjectProperties','ProjectsController@updateProjectProperties');
	Route::post('/saveitRequest','ProjectsController@updateProjectProperties');
	Route::get('/getOrganisationIntervenants','ProjectsController@getOrganisationIntervenants');

	//- Users management Routes
	Route::get('/listUsers','UsersController@listUsers');
	Route::get('/viewuser/{id}','UsersController@viewUser');
	Route::get('/edituser/{id}','UsersController@editUser');
	Route::post('/saveuserEditRequest','UsersController@updateUserInfo');
	Route::get('/newUser','UsersController@newUser');
	Route::post('/saveNewUser','UsersController@saveNewUser');
});

