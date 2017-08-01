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
use PDF;
use Excel;
use File;

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
        else if($role == "Approver")
            $layout = "AI_ORG_layouts.Approver";
        else if($role == "QA")
            $layout = "AI_ORG_layouts.QA";

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

    public function getModifiyFindingView()
    {
        $findings = Finding::where('project_id',session('currentProject'))->orderBy('created_at','asc')->get();
        $findings = $findings->groupby('finding');
        return $this->getRoleAndSet('isaMan.modifyAFinding','findings',$findings);
    }	

    public function getDisplayFindingView(Request $req)
	{
        $request = (Object) $req;
        $data = $request->all();

        $name = Finding::where('project_id',session('currentProject'))->where('id',$data['id'])->get()->first()->finding;
        $findings = Finding::where('project_id',session('currentProject'))->where('finding',$name)->get();

		return $this->getRoleAndSet('isaMan.displayFinding','findings',$findings);
	}

	public function getModifiedFindingsView()
	{
		$findings = Finding::where('project_id',session('currentProject'))->orderBy('created_at','asc')->get();
        $findings = $findings->groupby('finding');
        return $this->getRoleAndSet('isaMan.modifiedFindings','findings',$findings);
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
        $finding->save();
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
        $finding->save();
    }

    public function saveFindingModification(Request $req)
    {
        $request = (Object) $req;
        $data = $request->all();
        $id = $data['theid'];

        $prevfinding = Finding::where('id',$id)->get()->last();
        $finding = $prevfinding->replicate();
        $finding->description = $data['finding']['newdescription'];
        $finding->recommendation = $data['finding']['newrecommendation'];
        $finding->finding = $data['finding']['newfinding'];
        $finding->document_id = $data['finding']['newdocument'];
        $finding->severity = $data['finding']['newseverity'];
        $finding->responsable = $data['finding']['newresponsable'];
        $finding->response= '';
        $cycle = substr($prevfinding->cycle,0,1) +1;
        $finding->cycle = $cycle."O";
        $finding->save();


    }

    public function getGenerateROBSView(){
        $findings = Finding::where('project_id',session('currentProject'))->orderBy('created_at','asc')->get();
        $findings = $findings->groupby('finding');
        return $this->getRoleAndSet('isaMan.generateROBS','findings',$findings);
    }


    public function generateROBSPDF(Request $req)
    {
        $request = (Object) $req;
        $data = $request->all();

        $array = array();

        foreach ($data['finding'] as $key => $value)
            array_push($array, $key);

        $name = Finding::where('project_id',session('currentProject'))->whereIn('id',$array)->get(['finding']);
        $data = Finding::where('project_id',session('currentProject'))->whereIn('finding',$name)->get(['finding','cycle','description','document_id','recommendation','status','severity','created_at','user_id','responsable','updated_at'])->groupby('finding');
        
        $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
        $filename = 'ROBS';
        /*$file = Excel::create('ROBS', function($excel) use($data) {
            $excel->sheet('Finding', function($sheet) use($data){
                
                 $sheet->loadView('xls.ROBS', array('findings' => $data));
                $sheet->setAutoSize(true);
            });
        })->store('xls', $storagePath.'/public/download/'.session('currentProject').'/'.Baseline::where('id',session('currentBaseline'))->get()->first()->version.'/');
        */

        $pdf = PDF::loadView('pdf.ROBS',['findings' => $data])->setPaper('a4', 'landscape');
        $pdf->setOptions(['isPhpEnabled' => true]);
        $file = $pdf->output();
        $pdf->save($storagePath.'/public/download/'.session('currentProject').'/'.Baseline::where('id',session('currentBaseline'))->get()->first()->version.'/ROBS.pdf');


        $entry = Document::where('title','ROBS.pdf')->where('baseline_id',session('currentBaseline'))->get()->first();
        
        if(!$entry)
        {
           $entry = new Document;
            $entry->title = $filename;
            $entry->baseline_id = session('currentBaseline');
            $entry->url = '/public/download/'.session('currentProject').'/'.Baseline::where('id',session('currentBaseline'))->get()->first()->version.'/ROBS.pdf';
            $entry->valid = 1;
            $entry->user_id = Auth::user()->id;
            $entry->save();
        }

        return $entry->url;
    }


    public function generateROBSXLS(Request $req)
    {
        $request = (Object) $req;
        $data = $request->all();

        $array = array();

        foreach ($data['finding'] as $key => $value)
            array_push($array, $key);

        $name = Finding::where('project_id',session('currentProject'))->whereIn('id',$array)->get(['finding']);
        $data = Finding::where('project_id',session('currentProject'))->whereIn('finding',$name)->get(['finding','cycle','description','document_id','recommendation','status','severity','created_at','user_id','responsable','updated_at'])->groupby('finding');
        
        $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
        $filename = 'ROBS.xls';
        $file = Excel::create('ROBS', function($excel) use($data) {
            $excel->sheet('Finding', function($sheet) use($data){
                
                 $sheet->loadView('xls.ROBS', array('findings' => $data));
                $sheet->setAutoSize(true);
            });
        })->store('xls', $storagePath.'/public/download/'.session('currentProject').'/'.Baseline::where('id',session('currentBaseline'))->get()->first()->version.'/');
        
        $entry = Document::where('title','ROBS.xls')->where('baseline_id',session('currentBaseline'))->get()->first();
        
        if(!$entry)
        {
           $entry = new Document;
            $entry->title = $filename;
            $entry->baseline_id = session('currentBaseline');
            $entry->url = '/public/download/'.session('currentProject').'/'.Baseline::where('id',session('currentBaseline'))->get()->first()->version.'/ROBS.xls';
            $entry->valid = 1;
            $entry->user_id = Auth::user()->id;
            $entry->save();
        }
        return $entry->url;
    }

}
