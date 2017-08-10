<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\UploadedFile;
use App\Document;
use App\Documentai;
use App\Missingdoc;
use App\Baseline;
use App\Pparticipant;
use App\Project;
use Session;
use App;
use Auth;
use App\User;
use App\Norme;
use App\NormesAssignement;
use App\Evaluation;
use Barryvdh\Debugbar\Facade as Debugbar;


class documentsController extends Controller
{

    public function uploadFile(){
        $baselines = Baseline::where('status','opened')->count();
        if($baselines == 0)
            $base = 'locked';
        else $base = 'opened';
        
        return getRoleAndSet('docMan.uploadFile','baselines',$base);
    }

    public function viewDocuments(){
        $baselines = Project::find(session('currentProject'))->baselines;
        return getRoleAndSet('docMan.viewDocuments','baselines',$baselines);
    }

    public function listOfDocuments(){

        $baselines = Project::where('id',session('currentProject'))->first()->baselines;
        return getRoleAndSet('docMan.listOfDocuments','baselines',$baselines);
    }


    public function storeFile(Request $request){
        $role = Auth::user()->role;
        $existingfiles = array();

        if($request->hasfile('files'))
		{
            $fi = Input::file('files');
			foreach ($fi as $f) {
                $filename = $f->getClientOriginalName();

                if($role == "Lead Assessor" || $role == "Assessor" || $role == "Project Manager" || $role == "Approver" || $role == "QA" )
                {
                    $entry = new Documentai;
                    $entry->valid = 1;
                    $entry->accessibility = 0;
                    $entry->title = $filename;
                    $entry->baseline_id = Baseline::where('project_id',session('currentProject'))->where('status','opened')->get()[0]->id;
                    $entry->url = "/public/download/".session('currentProject').'/'.$entry->baseline->version."/".$filename;
                    
                    $entry->user_id = Auth::user()->id;
                    $entry->save();

                    $file = $f->storeAs("/public/download/".session('currentProject').'/'.$entry->baseline->version."/",$filename);
                }
                else
                {

                    $search = Document::where('title',$filename)->where('baseline_id',Baseline::where('project_id',session('currentProject'))->where('status','opened')->get()[0]->id)->get()->first();
                    if(empty($search))
                    {
                        $entry = new Document;
                        $entry->valid = 0;
                        $entry->title = $filename;
                        $entry->baseline_id = Baseline::where('project_id',session('currentProject'))->where('status','opened')->get()[0]->id;
                        $entry->url = "/public/download/".session('currentProject').'/'.$entry->baseline->version."/".$filename;
                        
                        $entry->user_id = Auth::user()->id;
                        $entry->save();

                        $file = $f->storeAs("/public/download/".session('currentProject').'/'.$entry->baseline->version."/",$filename);
                    }
                    else array_push($existingfiles, $filename);
                }
                
            }
        }
        Session::flash('redirect', 'showuploadFile');
        if(!empty($existingfiles))
            Session::flash('message', "Files : \n \n \t".implode(" \n\t",$existingfiles)." \n \n has not been uploaded (already exists in this baseline), all the other files has been uploaded, please modify them specify their version and phase");
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
        if($document->phase == null || $document->version == null)
            return "false";
        else {
            $document->valid = 1;
            $document->save();
            return "true";
        }

        Session::flash('message', "Document validated");
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

        $document = Document::where('id',$request->id)->get()->first();
        $document->version = $request->version;
        $document->phase = $request->phase;
        $document->user_id = Auth::user()->id;
        $document->valid = 0;
        
        if($request->hasfile('file'))
        {   
            Storage::delete($document->url);
            $request->file->storeAs("/public/download/".session('currentProject').'/'.Baseline::where('id',session('currentBaseline'))->get()->first()->version."/",$request->file->getClientOriginalName());
            $document->url = "/public/download/".session('currentProject').'/'.Baseline::where('id',session('currentBaseline'))->get()->first()->version."/".$request->file->getClientOriginalName();

            $document->title = $request->file->getClientOriginalName();
        }
        else {
            $oldTitle = $document->title;
            $newTitle = $request->title;
            $oldURL = $document->url;
            $newURL = str_replace($oldTitle, $newTitle, $oldURL);
            $document->url = $newURL;
            $document->title = $request->title;
            Storage::move($oldURL, $newURL);
        }

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

    public function getMissingDocumentsView(){
        $Docs = Missingdoc::where('project_id',session('currentProject'))->where('valid',1)->get();

        return getRoleAndSet('isaMan.missingDocuments','documents',$Docs);
    }

    public function getAddMissingDocumentsAlertView(){
        $users = Pparticipant::where('project_id',session('currentProject'))->where('role_id','>',6)->where('role_id','<',9)->orderBy('created_at')->get();
        $normes = NormesAssignement::with('normesphase')->where('project_id',session('currentProject'))->get();

        $data = array(
            'users'  => $users,
            'normes' => $normes
        );

        return getRoleAndSet('isaMan.newMissingDoc','data',$data);

    }

    public function saveNewMissingDocAlert(Request $request){
        $request = (Object) $request;
        $data = $request->all();

        $missingDocument = new Missingdoc;
        $missingDocument->title = $data['document']['title'];
        $missingDocument->phase = $data['document']['phase'];
        $missingDocument->responsable = $data['document']['responsable'];
        $missingDocument->user_id = Auth::user()->id;
        $missingDocument->project_id = session('currentProject');
        $missingDocument->valid = 1;

        $missingDocument->save();


    }

    public function missingDocAdded(Request $request){
        $request = (Object) $request;
        $data = $request->all();

        $missingDocument = Missingdoc::where('id',$data['id'])->get()->first();
        $missingDocument->valid = 0;

        $missingDocument->save();
    }

    public function getEvaluationStates(Request $req){
        
        $states = Evaluation::all();
        return $states;
    }   

    public function changeStatus(Request $req){
        $request = (Object) $req;
        $data = $request->all();
        $document = Document::where('id',$data['document'])->get()->first();
        $document->evaluation_id = $data['stat'];
        $document->save();
    }   

}
