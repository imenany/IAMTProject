<?php
use App\Notification;
use App\Pparticipant;
use App\User;


    function getRoleAndSet($view,$name,$data){
        $role = Auth::user()->role;

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

    function createNotification($userid, $responsable, $notif, $type){
       $users = Pparticipant::where('project_id',session('currentProject'))->get();

       if($responsable == 'client')
            foreach ($users as $user) {
                if(User::where('id',$user->user_id)->get()->first()->isclient && $user->user_id != Auth::user()->id)
                {
                    $notification = new Notification;
                    $notification->user_id = Auth::user()->id;
                    $notification->responsable = $user->user_id;
                    $notification->project_id = session('currentProject');
                    $notification->type = $type;
                    $notification->seen = 0;
                    $notification->notification = $notif;
                    $notification->save();
                }
            }
        else if($responsable == 'ia')
            foreach ($users as $user) {
                if(User::where('id',$user->user_id)->get()->first()->isia & $user->user_id != Auth::user()->id)
                {
                    $notification = new Notification;
                    $notification->user_id = Auth::user()->id;
                    $notification->responsable = $user->user_id;
                    $notification->project_id = session('currentProject');
                    $notification->type = $type;
                    $notification->seen = 0;
                    $notification->notification = $notif;
                    $notification->save();
                }
            }
        else if($responsable == 'all')
            foreach ($users as $user) {
                if((User::where('id',$user->user_id)->get()->first()->isclient || User::where('id',$user->user_id)->get()->first()->isia) && $user->user_id != Auth::user()->id)
                {
                    $notification = new Notification;
                    $notification->user_id = Auth::user()->id;
                    $notification->responsable = $user->user_id;
                    $notification->project_id = session('currentProject');
                    $notification->type = $type;
                    $notification->seen = 0;
                    $notification->notification = $notif;
                    $notification->save();
                }
            }
        else 
            {
                $notification = new Notification;
                $notification->user_id = Auth::user()->id;
                $notification->responsable = $responsable;
                $notification->project_id = session('currentProject');
                $notification->type = $type;
                $notification->seen = 0;
                $notification->notification = $notif;
                $notification->save();
            }

    }

?>