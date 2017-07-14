<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\UploadedFile;
use App\Document;
use App\Baseline;
use App\Project;
use Session;
use App;

class documentsController extends Controller
{
    public function uploadFile(){
    	return view('docMan/uploadFile');
    }

    public function viewDocuments(){
    	//$files = Storage::files('/public/download/'.session('currentProject').'/'.Baseline::find(session('currentBaseline'))->version);
        $baselines = Project::find(session('currentProject'))->baselines;
        
       	return view('docMan/viewDocuments')->with('baselines',$baselines);
    }

    public function listOfDocuments(){
        $baselines = Project::where('id',session('currentProject'))->first()->baselines;
        return view('docMan/listOfDocuments')->with('baselines',$baselines);
    }

    public function listOfBaselines(){
        $baselines = Project::where('id',session('currentProject'))->first()->baselines;
        return view('docMan/listOfBaselines')->with('baselines',$baselines);
    }

    public function storeFile(Request $request){
        if($request->hasfile('files'))
		{
            $fi = Input::file('files');
			foreach ($fi as $f) {
                $filename = $f->getClientOriginalName();
                $file = $f->storeAs('public/download',$filename);
                $entry = new Document;
                /*if(Document::where('title',$filename)->first())
                    $entry->title = $filename."0.1";
                else $entry->title = $filename;*/
                $entry->title = $filename;
                $entry->baseline_id = Baseline::where('project_id',session('currentProject'))->get()[0]->id;
                $entry->url = "public/download/".session('currentProject').'/'.Baseline::find(Project::find($entry->baseline_id)->id)->version."/".$filename;
                $entry->save();
            }
			return view('docMan/uploadFile')->with('ok', "yes");
		} else return view('docMan/uploadFile')->with('ok', "no");
    }

    public function deleteFile($id)
    {
    	return Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
    }

    public function modifyDoc()
    {
        $baselines = Project::where('id',session('currentProject'))->first()->baselines;
        return view('docMan/modifyDocument')->with('baselines',$baselines);

    }

}
