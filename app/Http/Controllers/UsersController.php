<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\UploadedFile;
use App\User;
use Mail;
use App\Mail\Mailtrap;

class UsersController extends Controller
{
    public function listUsers()
    {
        $users = User::all();
        return view('AI_layouts.content.usersList')->with('users',$users);
    }

    public function viewUser($id)
    {
        $user = User::find($id);
        return view('AI_layouts.content.viewuser')->with('user',$user);
    }

    public function editUser($id)
    {
        $user = User::find($id);
        return view('AI_layouts.content.edituser')->with('user',$user);
    }

    public function updateUserInfo(Request $req)
    {
        $request = (Object) $req;
        $data = $request->all();


        $user = User::find($data['user']['id']);
        $user->first_name = $data['user']['firstname'];
        $user->last_name = $data['user']['lastname'];
        $user->email = $data['user']['email'];
        $user->fonction = $data['user']['fonction'];
        $user->organisation = $data['user']['organisation'];
        $user->save();

        return 'Done';
    }

    public function saveNewUser(Request $req)
    {
        $request = (Object) $req;
        $data = $request->all();
        $pw = User::generatePassword();


        $exists = User::where('email',$data['user']['email'])->first();
        
        if($exists)
            return Response::json(['error' => 'Error msg'], 404);

        $user = new User;
        $user->first_name = $data['user']['firstname'];
        $user->last_name = $data['user']['lastname'];
        $user->email = $data['user']['email'];
        $user->fonction = $data['user']['fonction'];
        $user->organisation = $data['user']['organisation'];
        $user->password = $pw;
        $user->access = 0;
        $user->save();

        User::sendWelcomeEmail($user);

        return 'Done';
    }

    public function newUser()
    {
        return view('AI_layouts.content.newuser');
    }
}
