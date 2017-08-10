<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Baseline extends Model
{
    public function documents()
	{
		return $this->hasMany('App\Document');
	}

	public function documentsai()
	{
		return $this->hasMany('App\Documentai');
	}

	public function project()
	{
        return $this->belongsTo('App\Project');
	}
}
