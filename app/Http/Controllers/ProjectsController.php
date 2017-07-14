<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\User;
use App\Baseline;
use App\Pparticipant;
use Auth;
use App\Norme;
use App\Role;
use App\Normesphase;
use App\NormesAssignement;


class ProjectsController extends Controller
{

    public function newprojectview(Request $request)
    {
        $users = User::all();
        $normes = Norme::all();
        return view('AI_layouts.content.newProject')->with('normes',$normes)->with('users',$users);
    }


    public function insertnewproject(Request $request)
    {
        $request = (Object) $request;
        $data = $request->all();
        
        $projectID = new Project;
        $projectID->title = $data['Project']['title'];
        $projectID->description = $data['Project']['description'];
        $projectID->dateDebut = date('Y-m-d',strtotime($data['Project']['dateD']));
        $projectID->dateFin = date('Y-m-d',strtotime($data['Project']['dateF']));
        $projectID->save();

        //Modify the project normes
        // key = phase_id     value = "on"
        
        if(isset($data['Phase']))
        foreach ($data['Phase'] as $key => $value) {
            $normesassignement = new NormesAssignement;
            $normesassignement->project_id = $projectID->id;
            $normesassignement->normesphase_id = $key; 
            $normesassignement->save(); 
        }

        if(isset($data['role']))
            foreach ($data['role'] as $user => $value) {
                $pp = new Pparticipant;
                $pp->project_id = $projectID->id;
                $pp->user_id = $user;
                $pp->role_id = Role::where('role',$value)->first()->id;  
                $pp->save(); 
            }
        return redirect('/projects/'.$projectID->id);

    }

    public function getproject($id)
    {
    	session(['currentProject' => $id]);
        $lastbl = Baseline::where('project_id',session('currentProject'))->where('status','opened')->get();
        if(!empty($lastbl->toArray()))
        {
            $curbl = $lastbl[0]->id;
            session(['currentBaseline' => $curbl]);
        } else session(['currentBaseline' => '0.0']);
        return view('project');
    }

    public function getprojects()
    {
        if(Auth::user()->fonction == 'admin'){
        	$projects = Project::All();
        	return $projects->toJson();
        } else {
	        $auth_user = Auth::user()->id;
	    	$projects_ids = Assignement::where('intervenant_id',$auth_user)->pluck('project_id')->toArray();
	    	$projects = Project::findMany($projects_ids);
	        return $projects->toJson();
	    }
    }    

    public function listProjects()
    {
        $projects = Project::all();
        return view('AI_layouts.content.projectList')->with('projects',$projects);
    }

    public function editproject($id)
    {
        $project = Project::find($id);
        $normes = Norme::all();
        $selectednormesids = array_map('current', $project->normesassignements->toArray());
        return view('AI_layouts.content.editproject')->with('project',$project)->with('normes',$normes)->with('selectednormes',$selectednormesids);
    }

    public function editPorjectProperties(Request $req)
    {
        $request = (Object) $req;
        $data = $request->all();
        //Modify the project informations
        $projectID = Project::find($data['Project']['id']);
        $projectID->title = $data['Project']['title'];
        $projectID->description = $data['Project']['description'];
        $projectID->dateDebut = date('Y-m-d',strtotime($data['Project']['dateD']));
        $projectID->dateFin = date('Y-m-d',strtotime($data['Project']['dateF']));
        $projectID->save();

        //Modify the project normes
        NormesAssignement::where('project_id', $projectID->id)->forceDelete();
        // key = phase_id     value = "on"
        foreach ($data['Phase'] as $key => $value) {
            $normesassignement = new NormesAssignement;
            $normesassignement->project_id = $projectID->id;
            $normesassignement->normesphase_id = $key; 
            $normesassignement->save(); 
        }

        //Modify the project assignements and users roles
        Pparticipant::where('project_id', $projectID->id)->forceDelete();
        if(isset($data['role']))
            foreach ($data['role'] as $user => $value) {
                if($value != "null")
                {
                    $pp = new Pparticipant;
                    $pp->project_id = $projectID->id;
                    $pp->user_id = $user;
                    $pp->role_id = Role::where('role',$value)->first()->id;  
                    $pp->save();
                } 
            }
        return redirect()->back();
    }

    public function getintervenants(Request $request)
    {

        $id =  $request->input('projectid');
        $users = User::all();

        return $users;
    }

    public function gettheintervenant(Request $request){
        $id =  $request->input('id');
        $intervenant = User::find($id);
        return $intervenant;
    }

    /*public function getAssociatedPhaseSteps(Request $req)
    {
        $request = (Object) $req;
        $data = $request->all();
        $phasesteps = Normesphase::find($data['id'])->normephasestep;
        return $phasesteps;
    }*/
}
