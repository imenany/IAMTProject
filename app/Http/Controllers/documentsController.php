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

class documentsController extends Controller
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

    public function uploadFile(){
        $baselines = Baseline::where('status','opened')->count();
        if($baselines == 0)
            $base = 'locked';
        else $base = 'opened';
        
        return $this->getRoleAndSet('docMan.uploadFile','baselines',$base);
    }

    public function viewDocuments(){
        $baselines = Project::find(session('currentProject'))->baselines;
        return $this->getRoleAndSet('docMan.viewDocuments','baselines',$baselines);
    }

    public function listOfDocuments(){

        $baselines = Project::where('id',session('currentProject'))->first()->baselines;
        return $this->getRoleAndSet('docMan.listOfDocuments','baselines',$baselines);
    }


    public function storeFile(Request $request){
        $role = Pparticipant::with('project')->where('user_id',Auth::user()->id)->where('project_id',session('currentProject'))->first()->role->role;
        if($request->hasfile('files'))
		{
            $fi = Input::file('files');
			foreach ($fi as $f) {
                $filename = $f->getClientOriginalName();

                $entry = new Document;

                $entry->title = $filename;
                $entry->baseline_id = Baseline::where('project_id',session('currentProject'))->where('status','opened')->get()[0]->id;
                $entry->url = "public/download/".session('currentProject').'/'.$entry->baseline->version."/".$filename;
                $entry->valid = 0;
                $entry->user_id = Auth::user()->id;
                $entry->save();
                $file = $f->storeAs("public/download/".session('currentProject').'/'.$entry->baseline->version."/",$filename);
            }
        }
        session(['redirect' => 'showallDocuments']);
        return back();
    }

    public function deleteFile($id)
    {
    	return Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
    }

    public function validateDocument(Request $req){
        $request = (Object) $req;
        $data = $request->all();

        $document = Document::where('id',$data['id'])->get()->first();
        $document->valid = 1;
        $document->save();
    }

    public function rejectDocument(Request $req){
        $request = (Object) $req;
        $data = $request->all();

        $document = Document::where('id',$data['id'])->get()->first();
        $document->forceDelete();
    }


    public function editDocument(Request $req){
        $request = (Object) $req;
        $data = $request->all();
        $id = $data['id'];

        $document = Document::where('id',$id)->get()->first();
        $phases = NormesAssignement::with('normesphase')->where('project_id',$document->baseline->project->id)->get();

        $data = array(
            'document'  => $document,
            'normes' => $phases
        );
        
        return $data;
    }
    
    public function saveEditionDoc(Request $request)
    {
        $request = (Object) $request;
        $data = $request->all();

        $document = Document::where('id',$data['document']['id'])->get()->first();
        $document->version = $data['document']['version'];
        $document->phase = $data['document']['phase'];
        $document->title = $data['document']['title'];
        $document->user_id = Auth::user()->id;
        $document->valid = 0;
        $document->save();

    }

    public function countInvalidDocs(Request $req){
        $count = Document::where('valid','0')->count();
        return $count;
    }

    public function getDocumentsToValidate(){
        $Docs = Document::where('valid','0')->get();
        return view('C_ORG_layouts.manager.docMan.validateDocs')->with('documents',$Docs);
    }

}
