<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Norme extends Model
{
    public function normephases()
	{
		return $this->hasMany('App\Normesphase');
	}
}
