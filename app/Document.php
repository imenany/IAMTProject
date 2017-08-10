<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
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

   public function baseline()
	{
        return $this->belongsTo('App\Baseline');
	}

    public function normesphase()
    {
        return $this->belongsTo('App\Normesphase','phase');
    }

    public function evaluation()
    {
        return $this->belongsTo('App\Evaluation');
    }
}
