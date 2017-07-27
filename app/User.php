<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Mail;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','first_name','last_name','fonction','organisation','access'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','access'
    ];


    public function pparticipants()
    {
        return $this->hasMany('App\Pparticipant');
    }


    public function documents()
    {
        return $this->hasMany('App\Document');
    }


    public static function generatePassword()
    {
      // Generate random string and encrypt it. 
      return bcrypt(str_random(35));
    }

    public static function sendWelcomeEmail($user)
    {
      // Generate a new reset password token
      $token = app('auth.password.broker')->createToken($user);
      
      // Send email
      Mail::send('Admin_layouts.content.email', ['user' => $user, 'token' => $token], function ($m) use ($user) {
        $m->from('hello@appsite.com', 'Your App Name');
        $m->to($user->email, $user->first_name)->subject('Welcome to APP');
      });
    }

}
