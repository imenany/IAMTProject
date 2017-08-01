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
use App\Message;


class ProjectsController extends Controller
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

    public function newprojectview(Request $request)
    {
        $users = User::all();
        $normes = Norme::all();
        $organisations = array_unique(User::all()->pluck('organisation')->toArray());
        return view('Admin_layouts.content.newProject')->with('normes',$normes)->with('users',$users)->with('organisations',$organisations);
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
        $projectID->organisation = $data['company'];
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
        return redirect('/listProjects');

    }

    public function getproject($id)
    {
        $role = Pparticipant::with('project')->where('user_id',Auth::user()->id)->where('project_id',$id)->first()->role->role;

        session(['currentProject' => $id]);
        session(['currentProjectName' => Project::where('id',$id)->get()->first()->title]);
        session(['role' => $role]);
        $lastbl = Baseline::where('project_id',session('currentProject'))->where('status','opened')->get();
        if(!empty($lastbl->toArray()))
        {
            $curbl = $lastbl[0]->id;
            session(['currentBaseline' => $curbl]);
        } else session(['currentBaseline' => '0.0']);


        $role = User::find(Auth::user()->id)->pparticipants->where('project_id',$id)->first()->role->role;
        
        return $this->getRoleAndSet('.project','data',null);

    }

    public function getprojects()
    {
        $auth_user = Auth::user()->id;
        $projects_ids = Pparticipant::with('project')->where('user_id',Auth::user()->id)->get();
        
        return $projects_ids;
    }    

    public function listProjects()
    {
        $projects = Project::all();
        return view('Admin_layouts.content.projectList')->with('projects',$projects);
    }

    public function editproject($id)
    {
        $project = Project::find($id);
        $normes = Norme::all();
        $selectednormesids = array_map('current', $project->normesassignements->toArray());
        return view('Admin_layouts.content.editproject')->with('project',$project)->with('normes',$normes)->with('selectednormes',$selectednormesids);
    }

    public function updateProjectProperties(Request $req)
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
        
        if(isset($data['Phase']))
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
        $users = User::whereIn('organisation',[Project::where('id',$id)->first()->organisation,'Viattech Q&S'])->get();
        return $users;
    }

    public function getProjectintervenants(Request $request)
    {
        $id =  session('currentProject');
        $users = User::whereIn('organisation',[Project::where('id',$id)->first()->organisation,'Viattech Q&S'])->get();
        return $users;
    }

    public function gettheintervenant(Request $request){
        $id =  $request->input('id');
        $intervenant = User::find($id);
        return $intervenant;
    }

    public function getOrganisationIntervenants(Request $req)
    {
        $name =  $req->input('orgname');
        $intervenants = User::where('organisation',$name)->get();

        return $intervenants;
    }

    public function getMessages()
    {       
        $messages = Message::with('user')->where('project_id',session('currentProject'))->get();
        return $messages;
    }

    public function addMessage(Request $req){
        $message = $req->input('message');

        $entry = new Message;
        $entry->message = $message;
        $entry->user_id = Auth::user()->id;
        $entry->project_id = session('currentProject');
        $entry->save();

        return 'data';
    }


    public function getProjectParticipantsView(){
        $project = Project::find(session('currentProject'));
        $users = User::whereIn('organisation',[Project::where('id',session('currentProject'))->first()->organisation,'Viattech Q&S'])->get();

        $array = array('project' => $project, 'users' => $users);

        return $this->getRoleAndSet('isaMan.pparticipantsManagement','data',$array);
    }

    public function changeParticipants(Request $req)
    {
        $request = (object) $req;
        $data = $request->all();

        Pparticipant::where('project_id', session('currentProject'))->forceDelete();
        if(isset($data['role']))
        {
            foreach ($data['role'] as $user => $value) {
                if($value != "null")
                {
                    $pp = new Pparticipant;
                    $pp->project_id = session('currentProject');
                    $pp->user_id = $user;
                    $pp->role_id = Role::where('role',$value)->first()->id;  
                    $pp->save();
                } 
            }
            return 'true';
        }
        else return 'false';
    }


    public function getProjectPhasesView(){
        $project = Project::find(session('currentProject'));
        $normes = Norme::all();
        $selectednormesids = array_map('current', $project->normesassignements->toArray());
        
        $array = array('project' => $project, 'normes' => $normes, 'selectednormes' => $selectednormesids);
        return $this->getRoleAndSet('isaMan.phasesManagement','data',$array);
    }

    public function changePhases(Request $req)
    {
        $request = (object) $req;
        $data = $request->all();


        if(isset($data['Phase']))
        {   
            NormesAssignement::where('project_id', session('currentProject'))->forceDelete();
            foreach ($data['Phase'] as $key => $value) {
                $normesassignement = new NormesAssignement;
                $normesassignement->project_id = session('currentProject');
                $normesassignement->normesphase_id = $key; 
                $normesassignement->save(); 
            }
            return 'true';
        }
        else return 'false';

    }


    public function geDocumentsAccessibilityView(){

        $documents = Project::where('id',session('currentProject'))->get()->first()->baselines;



        $array = array('project' => $project, 'normes' => $normes, 'selectednormes' => $selectednormesids);
        return $this->getRoleAndSet('isaMan.phasesManagement','data',$array);
    }

}
