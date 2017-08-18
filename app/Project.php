<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Request;


class Project extends Model
{
    
	/*
	* a project has many baselines
	*/
	/*
	public function baselines()
	{
		return $this->belongsTo('App\Baseline');
	}
	*/

	/*public function baselines()
    {
        return $this->hasMany('App\Baseline','project_id','id');
    }*/

    public function baselines()
	{
		return $this->hasMany('App\Baseline');
	}

	public function normesassignements()
	{
		return $this->hasMany('App\Normesassignement')->select('normesphase_id');
	}

    public function pparticipants()
	{
		return $this->hasMany('App\Pparticipant');
	}

    public function getManagerAttribute(){
        $manager = Pparticipant::with('project')->where('project_id',session('currentProject'))->where('role_id',7)->first()->user;
        return $manager;
    }

    public function getLeadassessorAttribute(){
        $LA = Pparticipant::with('project')->where('project_id',session('currentProject'))->where('role_id',2)->first()->user;
        return $LA;
    }

}
