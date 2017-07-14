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
   
   public function baseline()
	{
        return $this->belongsTo('App\Baseline');
	}
}
