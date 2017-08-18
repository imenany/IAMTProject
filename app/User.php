<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Mail;
use App\Pparticipant;
use Auth;
use App\Notifications\NewUserCreated;
use App\Notifications\ProjectCreated;
use Response;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','first_name','last_name','fonction','organisation','access'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','access'
    ];


    public function pparticipants()
    {
        return $this->hasMany('App\Pparticipant');
    }


    public function documents()
    {
        return $this->hasMany('App\Document');
    }


    public static function sendProjectCreatedEmail($role,$user)
    {
      $user->notify(new ProjectCreated($role->role));
    }

    public static function sendWelcomeEmail($user)
    {
      // Generate a new reset password token
      $token = app('auth.password.broker')->createToken($user);
      $user->notify(new NewUserCreated($token));
    }

    public function getRoleAttribute()
    {

        $role = Pparticipant::with('project')->where('user_id',$this->id)->where('project_id',session('currentProject'))->first()->role->role;
        return $role;
    }

    public function getIsiaAttribute()
    {

        $role = Pparticipant::with('project')->where('user_id',$this->id)->where('project_id',session('currentProject'))->first()->role->role;
        if($role == 'Lead Assessor' || $role == 'Assessor' || $role == 'Project Manager' || $role == 'Approver' || $role == 'QA')
          return true;
        else return false;
    }

    public function getIsclientAttribute()
    {

        $role = Pparticipant::with('project')->where('user_id',$this->id)->where('project_id',session('currentProject'))->first()->role->role;
        if($role == 'Lead Assessor' || $role == 'Assessor' || $role == 'Project Manager' || $role == 'Approver' || $role == 'QA')
          return false;
        else return true;
    }

    public function getIsleadassessorAttribute()
    {
        $role = Pparticipant::with('project')->where('user_id',$this->id)->where('project_id',session('currentProject'))->first()->role->role;
        if($role == 'Lead Assessor')
          return true;
        else return false;
    }

    public function getIsassessorAttribute()
    {
        $role = Pparticipant::with('project')->where('user_id',$this->id)->where('project_id',session('currentProject'))->first()->role->role;
        if($role == 'Assessor')
          return true;
        else return false;
    }

    public function getIsprojectmanagerAttribute()
    {
        $role = Pparticipant::with('project')->where('user_id',$this->id)->where('project_id',session('currentProject'))->first()->role->role;
        if($role == 'Project Manager')
          return true;
        else return false;
    }

    public function getIsapproverAttribute()
    {
        $role = Pparticipant::with('project')->where('user_id',$this->id)->where('project_id',session('currentProject'))->first()->role->role;
        if($role == 'Approver')
          return true;
        else return false;
    }

    public function getIsqaAttribute()
    {
        $role = Pparticipant::with('project')->where('user_id',$this->id)->where('project_id',session('currentProject'))->first()->role->role;
        if($role == 'QA')
          return true;
        else return false;
    }

    public function getFullnameAttribute(){
        return $this->first_name . " " . $this->last_name;
    }

}
