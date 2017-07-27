<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\UploadedFile;
use App\Document;   
use App\Baseline;
use App\Pparticipant;
use App\Project;
use Session;
use App;
use Auth;
use App\User;
use App\Norme;
use App\NormesAssignement;
use App\Finding;
use Barryvdh\Debugbar\Facade as Debugbar;

class FindingsController extends Controller
{

    public function getRoleAndSet($view,$name,$data){
        $role = Pparticipant::with('project')->where('user_id',Auth::user()->id)->where('project_id',session('currentProject'))->first()->role->role;
        if($role == "Manager")
            $layout = "C_ORG_layouts.manager";
        else if($role == "Project Participant")
            $layout = "C_ORG_layouts.pparticipant";
        else if($role == "Guest")
            $layout = "C_ORG_layouts.guest";
        else if($role == "Lead Assessor")
            $layout = "AI_ORG_layouts.LeadAssessor";
        else if($role == "Assessor")
            $layout = "AI_ORG_layouts.Assessor";
        else if($role == "Project Manager")
            $layout = "AI_ORG_layouts.ProjectManager";

        if(is_array($data))
            return view($layout.'.'.$view)->with($data)->render();
        else
            return view($layout.'.'.$view)->with($name,$data)->render();
    }

	public function getAllFindingsView()
	{
        $findings = Finding::where('project_id',session('currentProject'))->orderBy('created_at','asc')->get();
        $findings = $findings->groupby('finding');
		return $this->getRoleAndSet('isaMan.allFindings','findings',$findings);
	}

	public function getAddFindingView()
	{
        $users = Pparticipant::where('project_id',session('currentProject'))->where('role_id','>',6)->where('role_id','<',9)->orderBy('created_at')->get();
        $documents = Baseline::where('project_id',session('currentProject'))->where('status','opened')->get()[0]->documents->where('valid',1);
        
        $data = array(
            'documents'  => $documents,
            'users' => $users
        );

		return $this->getRoleAndSet('isaMan.addFindings','data', $data);
	}

    public function getModifiyFindingView($id)
    {
        return $this->getRoleAndSet('isaMan.modifyFinding','',null);
    }	

    public function getDisplayFindingView(Request $req)
	{
        $request = (Object) $req;
        $data = $request->all();

        $name = Finding::where('project_id',session('currentProject'))->where('id',$data['id'])->get()->first()->finding;
        $findings = Finding::where('project_id',session('currentProject'))->where('finding',$name)->get();

		return $this->getRoleAndSet('isaMan.displayFinding','findings',$findings);
	}

	public function getModifiedFindingsView($id)
	{
		
		return $this->getRoleAndSet('isaMan.modifiedFindings','',null);
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
        $finding->valid = 1;

        $finding->save();

        session(['redirect' => 'showAllFindings']);
        return back();
    }

    public function getFindingData(Request $req)
    {
        $request = (Object) $req;
        $data = $request->all();
        $id = $data['id'];


        $finding = Finding::where('id',$id)->orderBy('created_at')->get()->first();
        return $finding;

    }

    public function saveFindingResponse(Request $req)
    {
        $request = (Object) $req;
        $data = $request->all();
        $id = $data['id'];

        $prevfinding = Finding::where('id',$id)->get()->first();
        $finding = $prevfinding->replicate();
        $finding->response = $data['response'];
        $finding->cycle = substr($prevfinding->cycle,0,1)."R";
        $finding->save();
    }

    public function saveFindingResponseA(Request $req)
    {
        $request = (Object) $req;
        $data = $request->all();
        $id = $data['id'];

        $prevfinding = Finding::where('id',$id)->get()->last();
        $finding = $prevfinding->replicate();
        $finding->description = $data['descriptionA'];
        $finding->recommendation = $data['recommendationA'];
        $finding->response = '';
        $cycle = substr($prevfinding->cycle,0,1) +1;
        $finding->cycle = $cycle."O";
        $finding->save();
    }

}

