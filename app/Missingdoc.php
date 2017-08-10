<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Missingdoc extends Model
{
    
    public $table = "missingdoc";

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

   public function Project()
	{
        return $this->belongsTo('App\Project');
	}

    public function theresponsable()
    {
        return $this->belongsTo('App\User','responsable');
    }

    public function normephase()
    {
        return $this->belongsTo('App\Normesphase','phase');
    }


}
