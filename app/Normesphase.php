<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Normesphase extends Model
{
    public function norme()
	{
        return $this->belongsTo('App\Norme');
	}

	
}
