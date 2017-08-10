<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Robs extends Model
{
	public $table = "robstable";

    public function document()
	{
		return $this->belongsTo('App\Documentai','documentAI_id');
	}

	public function finding()
	{
		return $this->belongsTo('App\Finding');
	}

}
