<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /*
    public function baseline()
    {
    	return $this->hasOne('App\Baseline','id','baseline_id');
    }
    */
   
    public function user()
    {
        return $this->belongsTo('App\User');
    }

   public function project()
	{
        return $this->belongsTo('App\Project');
	}

}
