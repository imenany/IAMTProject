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
use App\Notification;
use Session;
use App;
use Auth;
use App\User;
use App\Norme;
use App\NormesAssignement;
use Barryvdh\Debugbar\Facade as Debugbar;


class baselineController extends Controller
{


    public function newBaseline()
    {
    	$exists = Project::find(session('currentProject'))->baselines->sortByDesc('updated_at')->first();

    	if($exists)
    	{
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
        $baseline = Baseline::where('project_id',session('currentProject'))->where('status','opened');
    	$baseline->update(['status' => 'locked']);
        createNotification(Auth::user()->id,'all','Baseline version : '.$baseline->get()->first()->version.' has been locked by '.Auth::user()->fullname.'.','Documents');

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
        $fields = $fields['field'];

        $files = array();


        foreach ($fields as $f) {
            	
                if(!(Input::file($f['file'])))
            	{
                    if($f['version'] == null)
                        array_push($files, $f['file']->getClientOriginalName());

        		        $filename = $f['file']->getClientOriginalName();
        		        $file = $f['file']->storeAs("public/download/".session('currentProject').'/'.Baseline::find($new_baseline->id)->version."/",$filename);
        		        $entry = new Document;
                        $entry->title = $filename;
                        $entry->valid = 0;
                        $entry->version = $f['version'];
        		        $entry->baseline_id = $new_baseline->id;
        		        $entry->url = "/public/download/".session('currentProject').'/'.Baseline::find($new_baseline->id)->version."/".$filename;
        		        $entry->save();
    	    	}
            
        }
        if(!empty($files))
            Session::flash('message', "Files : \n \n \t".implode(" \n\t",$files)." \n \n has no version, please modify them specify their version and phase");
        
        createNotification(Auth::user()->id,'all','Baseline version : '.$new_baseline->version.' has been created by '.Auth::user()->fullname.'.','Documents');

        Session::flash('redirect', 'showallBaselines');

        return back();
    }

	public function updateBaseline(Request $request)
    {
		$fields = $request->except('_token');
        $fields = $fields['field'];

    	//dd($fields);
    	$last_baseline = Baseline::where('project_id',session('currentProject'))->where('status','locked')->get()->sortByDesc('updated_at')->first();

    	$new_baseline = new Baseline;
    	$new_baseline->version = $last_baseline->version + 0.1;
    	$new_baseline->status = 'opened';
    	$new_baseline->project_id = session('currentProject');
    	$new_baseline->save();

        $files = array();
    	
        foreach ($fields as $f) {
            Debugbar::addMessage($f, 'f');
            if(array_key_exists('file',$f))
        	{
                Debugbar::addMessage(null, 'exists');
                if(!(Input::file($f['file'])))
    		      {
                    $filename = $f['file']->getClientOriginalName();
    		        $file = $f['file']->storeAs("public/download/".session('currentProject').'/'.Baseline::find($new_baseline->id)->version."/",$filename);
    		        $entry = new Document;
    		        $entry->title = $filename;
                    $entry->version = $f['version'];
                    $entry->baseline_id = $new_baseline->id;
                    $entry->user_id = Auth::user();
    		        $entry->url = "public/download/".session('currentProject').'/'.Baseline::find($new_baseline->id)->version."/".$filename;
    		        $entry->save();
                  }
            }else{
                Debugbar::addMessage(null, 'noo');
                $oldID = $f['oldFile'];
                $oldDoc = Document::where('id',$oldID)->get()->first();
                $entry = $oldDoc->replicate();
                $entry->baseline_id = $new_baseline->id;
                $entry->save();
                array_push($files, $entry->title);
            }
        }

        createNotification(Auth::user()->id,'all','Baseline version : '.$new_baseline->version.' has been created by '.Auth::user()->fullname.'.','Documents');

        if(!empty($files))
            Session::flash('message', "Files : \n \n \t".implode(" \n\t",$files)." \n \n has not been updated!");

        Session::flash('redirect', 'showallBaselines');
        return back();
    }



    public function listOfBaselines(){
        $baselines = Project::where('id',session('currentProject'))->first()->baselines;
        return getRoleAndSet('docMan.listOfBaselines','baselines',$baselines);
    }

    public function getOpenCloseBaselineView()
    {
        $baselines = Project::where('id',session('currentProject'))->get()->first()->baselines;
        return getRoleAndSet('baselineMan.openclosebaseline','baselines',$baselines);
    }

    public function getLockBaselineView(){
        $baseline = Project::where('id',session('currentProject'))->get()->first()->baselines->sortByDesc('created_at')->first();
        return getRoleAndSet('baselineMan.lockbaseline','baseline',$baseline);
    }

    public function closeBaselineRequest(Request $req){
        $request = (Object) $req;
        $data = $request->all();
        $id = $data['id'];

        $baseline = Baseline::where('id',$id)->get()->first();
        $baseline->status = "closed";
        $baseline->save();

        createNotification(Auth::user()->id,'all','Baseline version : '.$new_baseline->version.' has been closed by '.Auth::user()->fullname.'.','Documents');

        
        return $id;

    }

    public function openBaselineRequest(Request $req){
        $request = (Object) $req;
        $data = $request->all();
        $id = $data['id'];

        $baseline = Baseline::where('id',$id)->get()->first();
        $baseline->status = "opened";
        $baseline->save();
        
        createNotification(Auth::user()->id,'all','Baseline version : '.$new_baseline->version.' has been opened by '.Auth::user()->fullname.'.','Documents');

        return $id;

    }
}
