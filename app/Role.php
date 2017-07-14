<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function pparticipants()
	{
		return $this->hasMany('App\Pparticipant');
	}
}
