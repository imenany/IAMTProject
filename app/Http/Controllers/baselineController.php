<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\UploadedFile;
use App\Document;
use App\Baseline;
use App\Project;

class baselineController extends Controller
{
    public function newBaseline()
    {
    	$exists = Project::find(session('currentProject'))->baselines->sortByDesc('updated_at')->first();

    	if($exists)
    		{
    			//$documents = $exists->documents;
    			//dd($documents);
    			$status = $exists->status;
    			if(!strcmp($status, "locked"))
	    			return view("baselineMan.newBaseline")->with('exists',$exists);
	    		else if(!strcmp($status, "opened"))
	    			return view("baselineMan.newBaseline")->with('exists',$exists);
	    }

	    return view("baselineMan.newBaseline")->with('exists','false');

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
		        $entry->baseline_id = $new_baseline->id;
		        $entry->url = "public/download/".session('currentProject').'/'.Baseline::find($new_baseline->id)->version."/".$filename;
		        $entry->save();
	    	}
        }

        return redirect("/allDocuments");
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

    	/*$old_documents = $last_baseline->documents;

    	foreach ($old_documents as $document) {
    		Storage::copy($document->url,"public/download/".session('currentProject').'/'.$new_baseline->version."/".$document->title);
    	}*/
    	
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

        return redirect("/allDocuments");

    }
}
