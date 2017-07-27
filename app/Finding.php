<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Finding extends Model
{
   
    public function document()
    {
        return $this->belongsTo('App\Document');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function theresponsable()
    {
        return $this->belongsTo('App\User','responsable');
    }

    public function next(){
        return Finding::where('id', '>', $this->id)->orderBy('id','asc')->first();
    }
    public  function previous(){
        return Finding::where('id', '<', $this->id)->orderBy('id','desc')->first();
    }
}
