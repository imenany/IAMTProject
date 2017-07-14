<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Normesassignement extends Model
{
    public function project()
	{
        return $this->belongsTo('App\Project');
	}

	public function normesphase()
	{
        return $this->belongsTo('App\Normesphase');
	}
}
