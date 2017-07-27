<?php

namespace App\Http\Middleware;
use Auth;
use Session;
use Closure;
use App\Pparticipant;

class LeadAssessor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $role = Pparticipant::where('user_id',Auth::user()->id)->where('project_id',session('currentProject'))->get()->first()->role->role;
        
        if ($role == "Lead Assessor") {
            return $next($request);
        }else 
            return '';
    }
}
