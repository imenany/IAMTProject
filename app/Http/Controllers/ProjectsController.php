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
use App\Notification;


class ProjectsController extends Controller
{


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

                $user = User::where('id',$user)->get()->first();
                $role = Role::where('id',$pp->role_id)->get()->first();
                User::sendProjectCreatedEmail($role,$user);

            }
        return redirect('/listProjects');

    }

    public function getproject($id)
    {

        session(['currentProject' => $id]);
        session(['currentProjectName' => Project::where('id',$id)->get()->first()->title]);
        session(['role' => Auth::user()->role]);
        $lastbl = Baseline::where('project_id',session('currentProject'))->where('status','opened')->get();
        if(!empty($lastbl->toArray()))
        {
            $curbl = $lastbl[0]->id;
            session(['currentBaseline' => $curbl]);
        } else session(['currentBaseline' => '0.0']);
        
        return getRoleAndSet('.project','data',null);

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
        return redirect('/listProjects');
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

        return getRoleAndSet('isaMan.pparticipantsManagement','data',$array);
    }

    public function changeParticipants(Request $req)
    {
        $request = (object) $req;
        $data = $request->all();

        Pparticipant::where('project_id', session('currentProject'))->where('role_id','!=',2)->orWhereNull('role_id')->forceDelete();
        
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
        return getRoleAndSet('isaMan.phasesManagement','data',$array);
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
        return getRoleAndSet('isaMan.phasesManagement','data',$array);
    }

    public function getreviewingnotifications(){
        $notifications = Notification::where('project_id',session('currentProject'))->where('type','Reviewing')->where('responsable',Auth::user()->id)->where('seen',0)->get();
        return $notifications;
    }

    public function getfindingsnotifications(){
        $notifications = Notification::where('project_id',session('currentProject'))->where('type','Findings')->where('responsable',Auth::user()->id)->where('seen',0)->get();
        return $notifications;
    }

    public function getdocumentsnotifications(){
        $notifications = Notification::where('project_id',session('currentProject'))->where('type','Documents')->where('responsable',Auth::user()->id)->where('seen',0)->get();
        return $notifications;
    }

    public function setNotifcationSeen(Request $req){
        $request = (Object) $req;
        $data = $request->all();
        $id = $data['id'];

        $notification = Notification::where('id',$id)->get()->first();
        $notification->seen = 1;
        $notification->save();
    }


}
