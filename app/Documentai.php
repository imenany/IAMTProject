<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentAI extends Model
{
    public $table = "document_ais";
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
}
