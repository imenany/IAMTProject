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


class baselineController extends Controller
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

    public function newBaseline()
    {
    	$exists = Project::find(session('currentProject'))->baselines->sortByDesc('updated_at')->first();

    	if($exists)
    		{
    			//$documents = $exists->documents;
    			//dd($documents);
    			$status = $exists->status;
    			if(!strcmp($status, "locked"))
	    			return view("C_ORG_layouts.manager.baselineMan.newBaseline")->with('exists',$exists);
	    		else if(!strcmp($status, "opened"))
                    return view("C_ORG_layouts.manager.baselineMan.newBaseline")->with('exists',$exists);
	    }

	    return view("C_ORG_layouts.manager.baselineMan.newBaseline")->with('exists','false');

    }

    public function lockBaseline()
    {
    	Baseline::where('project_id',session('currentProject'))->where('status','opened')->update(['status' => 'locked']);
    }

    public function createBaseline(Request $request)
    {
    	$last_baseline = Baseline::where('project_id',session('currentProject'))->where('status','locked')->get()->sortByDesc('updated_at')->first();

    	$new_baseline = new Baseline;
    	$new_baseline->version = 0.0;
    	if($last_baseline)
    		$new_baseline->version = $last_baseline->version + 0.1;
    	$new_baseline->project_id = session('currentProject');
    	$new_baseline->status = 'opened';
    	$new_baseline->save();
        $fields = $request->except('_token');
       //	 dd($fields);
       //	 
        foreach ($fields as $f) {
        	if(!(Input::file($f)))
        	{
		        $filename = $f->getClientOriginalName();
		        $file = $f->storeAs("public/download/".session('currentProject').'/'.Baseline::find($new_baseline->id)->version."/",$filename);
		        $entry = new Document;
                $entry->title = $filename;
                $entry->valid = 0;
		        $entry->baseline_id = $new_baseline->id;
		        $entry->url = "public/download/".session('currentProject').'/'.Baseline::find($new_baseline->id)->version."/".$filename;
		        $entry->save();
	    	}
        }

        session(['redirect' => 'showallBaselines']);
        return back();
    }

	public function updateBaseline(Request $request)
    {
		$fields = $request->except('_token');
    	//dd($fields);
    	$last_baseline = Baseline::where('project_id',session('currentProject'))->where('status','locked')->get()->sortByDesc('updated_at')->first();

    	$new_baseline = new Baseline;
    	$new_baseline->version = $last_baseline->version + 0.1;
    	$new_baseline->status = 'opened';
    	$new_baseline->project_id = session('currentProject');
    	$new_baseline->save();

    	
        foreach ($fields as $f) {
        	if(!(Input::file($f)))
        	{
		        $filename = $f->getClientOriginalName();
		        $file = $f->storeAs("public/download/".session('currentProject').'/'.Baseline::find($new_baseline->id)->version."/",$filename);
		        $entry = new Document;
		        $entry->title = $filename;
		        $entry->baseline_id = $new_baseline->id;
		        $entry->url = "public/download/".session('currentProject').'/'.Baseline::find($new_baseline->id)->version."/".$filename;
		        $entry->save();
	    	}
        }

        session(['redirect' => 'showallBaselines']);
        return back();
    }



    public function listOfBaselines(){
        $baselines = Project::where('id',session('currentProject'))->first()->baselines;
        return $this->getRoleAndSet('docMan.listOfBaselines','baselines',$baselines);
    }

    public function getOpenCloseBaselineView()
    {
        $baselines = Project::where('id',session('currentProject'))->get()->first()->baselines;
        return $this->getRoleAndSet('baselineMan.openclosebaseline','baselines',$baselines);
    }

    public function getLockBaselineView(){
        $baseline = Project::where('id',session('currentProject'))->get()->first()->baselines->sortByDesc('created_at')->first();
        return $this->getRoleAndSet('baselineMan.lockbaseline','baseline',$baseline);
    }

    public function closeBaselineRequest(Request $req){
        $request = (Object) $req;
        $data = $request->all();
        $id = $data['id'];

        $baseline = Baseline::where('id',$id)->get()->first();
        $baseline->status = "closed";
        $baseline->save();
        
        return $id;

    }

    public function openBaselineRequest(Request $req){
        $request = (Object) $req;
        $data = $request->all();
        $id = $data['id'];

        $baseline = Baseline::where('id',$id)->get()->first();
        $baseline->status = "opened";
        $baseline->save();
        
        return $id;

    }
}
