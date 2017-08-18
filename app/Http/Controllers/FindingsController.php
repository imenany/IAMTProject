<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\UploadedFile;
use App\Document;   
use App\Documentai;   
use App\Baseline;
use App\Pparticipant;
use App\Project;
use App\ROBS;
use Session;
use App;
use Auth;
use App\User;
use App\Norme;
use App\NormesAssignement;
use App\Finding;
use Barryvdh\Debugbar\Facade as Debugbar;
use PDF;
use Excel;
use File;

class FindingsController extends Controller
{
	public function getAllFindingsView()
	{
        $user = Auth::user();

        if($user->isqa || $user->isapprover || $user->isprojectmanager)
            $findings = Finding::where('project_id',session('currentProject'))->where('valid',1)->orderBy('created_at','asc')->get();
        else if($user->isclient)
            $findings = Finding::where('project_id',session('currentProject'))->where('accessibility',1)->orderBy('created_at','asc')->get();
        else 
            $findings = Finding::where('project_id',session('currentProject'))->orderBy('created_at','asc')->get();

        $findings = $findings->groupby('finding');
		return getRoleAndSet('isaMan.allFindings','findings',$findings);
	}

	public function getAddFindingView()
	{
        $users = Pparticipant::where('project_id',session('currentProject'))->where('role_id','>',6)->where('role_id','<',9)->orderBy('created_at')->get();
        $documents = Baseline::where('project_id',session('currentProject'))->where('status','opened')->get()[0]->documents->where('valid',1);
        
        $data = array(
            'documents'  => $documents,
            'users' => $users
        );

		return getRoleAndSet('isaMan.addFindings','data', $data);
	}

    public function getModifiyFindingView()
    {
        $findings = Finding::where('project_id',session('currentProject'))->orderBy('created_at','asc')->get();
        $findings = $findings->groupby('finding');
        return getRoleAndSet('isaMan.modifyAFinding','findings',$findings);
    }	

    public function getDisplayFindingView(Request $req)
	{
        $request = (Object) $req;
        $data = $request->all();

        $name = Finding::where('project_id',session('currentProject'))->where('id',$data['id'])->get()->first()->finding;
        $findings = Finding::where('project_id',session('currentProject'))->where('finding',$name)->get();

		return getRoleAndSet('isaMan.displayFinding','findings',$findings);
	}

	public function getModifiedFindingsView()
	{
		$findings = Finding::where('project_id',session('currentProject'))->orderBy('created_at','asc')->get();
        $findings = $findings->groupby('finding');
        return getRoleAndSet('isaMan.modifiedFindings','findings',$findings);
	}

    public function addNewFinding(Request $req)
    {
        $request = (Object) $req;
        $data = $request->all();

        $last_cycle = Finding::where('project_id',session('currentProject'))->where('finding',$data['finding']['finding'])->get()->last();

        if($last_cycle)
        {        
            $i = substr($last_cycle->cycle,0,1);
            $cycle = ($i+1)."O";
        }
        else $cycle = '1O';

        $finding = new Finding;
        $finding->finding = $data['finding']['finding'];
        $finding->cycle = $cycle;
        $finding->document_id = $data['finding']['document'];
        $finding->project_id = session('currentProject');
        $finding->description = $data['finding']['description'];
        $finding->recommendation = $data['finding']['recommendation'];
        $finding->response = '';
        $finding->status = 'O';
        $finding->severity = $data['finding']['severity'];
        $finding->responsable = $data['finding']['responsable'];
        $finding->user_id = Auth::user()->id;
        $finding->valid = 0;
        $finding->accessibility = 0;

        $finding->save();

        session(['redirect' => 'showAllFindings']);
        return back();
    }

    public function getFindingData(Request $req)
    {
        $request = (Object) $req;
        $data = $request->all();
        $id = $data['id'];

        $pparticipants = Pparticipant::with('user')->where('project_id',session('currentProject'))->get();
        $documents = Document::where('baseline_id',session('currentBaseline'))->get();
        $finding = Finding::where('id',$id)->orderBy('created_at')->get()->first();

        $array = array('finding' => $finding, 'pparticipant' => $pparticipants, 'documents' => $documents);

        return $array;

    }

    public function saveFindingResponse(Request $req)
    {
        $request = (Object) $req;
        $data = $request->all();
        $id = $data['id'];

        $prevfinding = Finding::where('id',$id)->get()->first();
        $finding = $prevfinding->replicate();
        $finding->response = $data['finding']['response'];
        $finding->cycle = substr($prevfinding->cycle,0,1)."R";
        $finding->accessibility = 0;
        $finding->save();

        createNotification(Auth::user()->id,'ia','New response on finding '.$finding->finding.' has been added by '.Auth::user()->fullname.'.','Findings');
    }

    public function saveFindingResponseA(Request $req)
    {
        $request = (Object) $req;
        $data = $request->all();
        $id = $data['idA'];

        $prevfinding = Finding::where('id',$id)->get()->last();
        $finding = $prevfinding->replicate();
        $finding->description = $data['finding']['descriptionA'];
        $finding->recommendation = $data['finding']['recommendationA'];
        $finding->response = '';
        $cycle = substr($prevfinding->cycle,0,1) +1;
        $finding->cycle = $cycle."O";
        $finding->valid = 0;
        $finding->accessibility = 0;
        $finding->user_id = Auth::user()->id;
        $finding->save();
    }

    public function saveFindingModification(Request $req)
    {
        $request = (Object) $req;
        $data = $request->all();
        $id = $data['theid'];

        $finding = Finding::where('id',$id)->get()->last();
        $finding->description = $data['finding']['newdescription'];
        $finding->recommendation = $data['finding']['newrecommendation'];
        $finding->finding = $data['finding']['newfinding'];
        $finding->document_id = $data['finding']['newdocument'];
        $finding->severity = $data['finding']['newseverity'];
        $finding->responsable = $data['finding']['newresponsable'];
        $finding->response= '';
        /*$cycle = substr($prevfinding->cycle,0,1) +1;
        $finding->cycle = $cycle."O";*/
        $finding->valid = 0;
        $finding->accessibility = 0;
        $finding->save();

        $LA = Project::where('id',session('currentProject'))->get()->first()->leadassessor;
        createNotification(Auth::user()->id,$LA->id,'Finding '.$finding->finding.' has been modified by '.Auth::user()->fullname.'.','Findings');
    }

    public function validateFinding(Request $req)
    {
        $request = (Object) $req;
        $data = $request->all();
        $id = $data['id'];

        $finding = Finding::where('id',$id)->get()->first();
        $finding->valid = 1;

        createNotification(Auth::user()->id,$finding->user_id,'Your finding ('.$finding->finding.') has been validated by '.Auth::user()->fullname.'.','Findings');
        createNotification(Auth::user()->id,'ia','New finding added ('.$finding->finding.') by '.Auth::user()->fullname.'.','Findings');

        $finding->save();
    }

    public function rejectFinding(Request $req)
    {
        $request = (Object) $req;
        $data = $request->all();
        $id = $data['id'];

        $finding = Finding::where('id',$id)->get()->first();

        createNotification(Auth::user()->id,$finding->user_id,'Your finding ('.$finding->finding.') has been rejected by '.Auth::user()->fullname.'.','Findings');

        $finding->delete();
    }
}
