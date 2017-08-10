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
use App\Missingdoc;
use App\Project;
use App\ROBS;
use App\Commentaire;
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

class RobsController extends Controller
{

    public function getGenerateROBSView(){
        $findings = Finding::where('project_id',session('currentProject'))->orderBy('created_at','asc')->get();
        $findings = $findings->groupby('finding');
        return getRoleAndSet('isaMan.generateROBS','findings',$findings);
    }


    public function getallROBSView(){
        $ROBS = Documentai::where('baseline_id',session('currentBaseline'))->get();

        return getRoleAndSet('isaMan.cycleReview','ROBS',$ROBS);
    }

    public function geDocumentsAccessibilityView(){
        $ROBS = Documentai::where('baseline_id',session('currentBaseline'))->get();

        return getRoleAndSet('isaMan.documentsAccessibility','ROBS',$ROBS);
    }


    public function unhideDoc(Request $req)
    {
        $request = (Object) $req;
        $data = $request->all();

        $document = Documentai::where('id',$data['id'])->get()->first();
        $document->accessibility = 1;
        $document->save();
    }

    public function hideDoc(Request $req)
    {
        $request = (Object) $req;
        $data = $request->all();

        $document = Documentai::where('id',$data['id'])->get()->first();
        $document->accessibility = 0;
        $document->save();
    }

    public function validateROBS(Request $req)
    {
        $request = (Object) $req;
        $data = $request->all();

        $document = Documentai::where('id',$data['id'])->get()->first();

        if($data['user'] == "projectmanager")
            $document->approver = 1;
        elseif($data['user'] == "approver")
            $document->approver = 1;
        elseif($data['user'] == "qa")
            $document->qa = 1;
        elseif($data['user'] == "assessor")
            $document->assessor = 1;
        elseif($data['user'] == "leadassessor")
        {
            $document->leadassessor = 1;
            $document->valid = 1;

            $ROBS = ROBS::where('documentAI_id',$document->id)->get();
            foreach ($ROBS as $robs) {
                $id = $robs->finding->id;
                $finding = Finding::where('id',$id)->get()->first();
                $finding->accessibility = 1;
                $finding->save();
            }

        }

        $document->save();
    }

    public function unValidateROBS(Request $req)
    {
        $request = (Object) $req;
        $data = $request->all();

        $document = Documentai::where('id',$data['id'])->get()->first();

        if($data['user'] == "qa")
        {
            $document->approver = 0;
            $document->qa = 0;
            $document->projectmanager = 0;
            $document->assessor = 0;
            $document->leadassessor = 0;
            $document->valid = 0;
            $document->accessibility = 0;

        }    
        elseif($data['user'] == "approver")
        {
            $document->approver = 0;
            $document->projectmanager = 0;
            $document->assessor = 0;
            $document->leadassessor = 0;
            $document->valid = 0;
            $document->accessibility = 0;
        }
        elseif($data['user'] == "projectmanager")
        {
            $document->projectmanager = 0;
            $document->assessor = 0;
            $document->leadassessor = 0;
            $document->valid = 0;
            $document->accessibility = 0;
        } 
        elseif($data['user'] == "assessor")
        {
            $document->assessor = 0;
            $document->leadassessor = 0;
            $document->valid = 0;
            $document->accessibility = 0;
        } 
        elseif($data['user'] == "leadassessor")
        {
            $document->leadassessor = 0;
            $document->valid = 0;
            $document->accessibility = 0;
        }

        $ROBS = ROBS::where('documentAI_id',$document->id)->get();
        foreach ($ROBS as $robs) {
            $id = $robs->finding->id;
            $finding = Finding::where('id',$id)->get()->first();
            $finding->accessibility = 0;
            $finding->save();
        }
        $document->save();

    }


    public function generateROBSPDF(Request $req)
    {
        $request = (Object) $req;
        $data = $request->all();

         $filename = 'ROBS_'.date("Ymd-His").'.pdf';

        /******************** Create Document on SQL DB *************************/

        $entry = new Documentai;
        $entry->title = $filename;
        $entry->baseline_id = session('currentBaseline');
        $entry->url = '/public/download/'.session('currentProject').'/'.Baseline::where('id',session('currentBaseline'))->get()->first()->version.'/'.$filename;
        $entry->valid = 0;
        $entry->user_id = Auth::user()->id;
        $entry->save();


        /******************** Create Document LOCAL DB *************************/

        $array = array();

        foreach ($data['finding'] as $key => $value)
            array_push($array, $key);

        $name = Finding::where('project_id',session('currentProject'))->whereIn('id',$array)->get(['finding']);
        $data = Finding::where('project_id',session('currentProject'))->whereIn('finding',$name)->get(['finding','cycle','description','document_id','recommendation','status','severity','created_at','user_id','responsable','updated_at'])->groupby('finding');
        
        $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
        $filename = 'ROBS';
        $pdf = PDF::loadView('pdf.ROBS',['findings' => $data])->setPaper('a4', 'landscape');
        $pdf->setOptions(['isPhpEnabled' => true]);
        $file = $pdf->output();
        $pdf->save($storagePath.$entry->url);

        /******************** Associate Document to findings *************************/

        foreach ($array as $value) {
            $ROBS = new ROBS;
            $ROBS->documentAI_id = $entry->id;
            $ROBS->finding_id = $value;
            $ROBS->baseline_id = session("currentBaseline");
            $ROBS->save();
        }
        return $entry->url;
    }


    public function generateROBSXLS(Request $req)
    {
        $request = (Object) $req;
        $data = $request->all();

        $filename = 'ROBS_'.date("Ymd-His");

        /******************** Create Document on SQL DB *************************/

        
        
            $entry = new Documentai;
            $entry->title = $filename.".xls";
            $entry->baseline_id = session('currentBaseline');
            $entry->url = '/public/download/'.session('currentProject').'/'.Baseline::where('id',session('currentBaseline'))->get()->first()->version.'/'.$filename.'.xls';
            $entry->valid = 0;
            $entry->user_id = Auth::user()->id;
            $entry->save();


        /******************** Create Document LOCAL DB *************************/
        $array = array();

        foreach ($data['finding'] as $key => $value)
            array_push($array, $key);

        $name = Finding::where('project_id',session('currentProject'))->whereIn('id',$array)->get(['finding']);
        $findings = Finding::where('project_id',session('currentProject'))->whereIn('finding',$name)->get(['finding','cycle','description','document_id','recommendation','status','severity','created_at','user_id','responsable','updated_at'])->groupby('finding');

        $Docs = Project::where('id',session('currentProject'))->first()->baselines;
        
        $MissingDocs = Missingdoc::where('project_id',session('currentProject'))->where('valid',1)->get();

        $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();

        $file = Excel::create($filename, function($excel) use($findings, $Docs, $MissingDocs) {

            $excel->sheet('Documents Manquants', function($sheet) use($MissingDocs){
                $sheet->loadView('xls.MissingDocuments', array('Documents' => $MissingDocs));
                $sheet->setrowsToRepeatAtTop(15);

            });

            $excel->sheet('Documents', function($sheet) use($Docs){
                $sheet->loadView('xls.Documents', array('baselines' => $Docs));

            });

            $excel->sheet('Findings_ISA', function($sheet) use($findings){
                $sheet->loadView('xls.Findings_ISA', array('findings' => $findings));
            });

            $lastrow = $excel->getActiveSheet()->getHighestRow();    
            
            $excel->getActiveSheet()->getStyle('A1:Z'.$lastrow)->getAlignment()->setWrapText(true); 

        })->store('xls', $storagePath.'/public/download/'.session('currentProject').'/'.Baseline::where('id',session('currentBaseline'))->get()->first()->version.'/');
        

        

        /******************** Associate Document to findings *************************/

        foreach ($array as $value) {
            $ROBS = new ROBS;
            $ROBS->documentAI_id = $entry->id;
            $ROBS->finding_id = $value;
            $ROBS->baseline_id = session("currentBaseline");
            $ROBS->save();
        }


        return '/public/download/'.session('currentProject').'/'.Baseline::where('id',session('currentBaseline'))->get()->first()->version.'/'.$filename.'.xls';
    }


    public function getLastComment(Request $req){
        $request = (Object) $req;
        $data = $request->all();

        $comment = Commentaire::where('user_id',$data['userid'])->where('robstable_id',$data['robsid'])->get()->first();
        if(!empty($comment))
            return $comment;
        return 'null';
    } 

    public function saveROBSComment(Request $req){
        $request = (Object) $req;
        $data = $request->all();
        $comment = Commentaire::where('user_id',$data['userid'])->where('robstable_id',$data['robsid'])->get()->first();
        
        if(empty($comment))
            $comment = new Commentaire;

            $comment->user_id = $data['userid'];
            $comment->robstable_id = $data['robsid'];
            $comment->commentaire = $data['comment'];
            $comment->save();

    }

    public function getROBSComments(Request $req){
        $request = (Object) $req;
        $data = $request->all();

        $output = Commentaire::with('user')->where('robstable_id',$data['robsid'])->get();
        
        return $output; 
    }


}

