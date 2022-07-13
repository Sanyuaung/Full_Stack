<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\IsValidPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginhome()
    {
        return view("auth.login");
    }
    public function registerhome()
    {
        return view("auth.register");
    }
    public function register()
    {
        $validation = request()->validate([
            "username" => "required",
            "email" => "required",
            "password" => ['required', 'string', 'confirmed', new IsValidPassword()],
            // "image"=>"required",
        ]);
        if ($validation) {
            $auth = User::where('email', request("email"))->first();
            if ($auth) {
                Alert::error('Sorry', 'Email already exists 😭');
                return redirect()->back();
            } else {
                $password = $validation["password"];
                $user = new User();
                $user->name = $validation["username"];
                $user->email = $validation["email"];
                $user->department = "-";
                $user->password = Hash::make($password);
                $user->save();
                Alert::success('Congrats 🙂', 'You\'ve Successfully Registered');
                return redirect()->route('loginhome');
            }
        } else {
            return back()->withErrors($validation);
        }
    }
    public function login()
    {
        $validation = request()->validate([
            "email" => "required",
            "password" => "required",
        ]);
        if ($validation) {
            $auth = Auth::attempt(['email' => request("email"), 'status' => 1, 'password' => request("password")]);
            if ($auth) {
                Alert::info('Welcome ' . auth()->user()->name);
                return  redirect()->route('home');
            } else {
                Alert::error('Sorry 😭', 'Authentication Failed Try Again ...');
                return back();
            }
        } else {
            return back()->withErrors('$validation');
        }
    }
    public function logout()
    {
        Auth::logout();
        Alert::info('Thanks you!');
        return redirect()->route('login');
    }
    public function forgetpasswordhome()
    {
        return view("auth.forgetHome");
    }
    public function forgetpasswordvalidate()
    {
        $validation = request()->validate([
            "username" => "required",
            "email" => "required",
        ]);
        $username = request("username");
        $email = request("email");
        if ($validation) {
            $auth = DB::select("select * from users where name='$username' and email='$email'");
            if ($auth) {
                return view("auth.forgetPassword", ['old' => $auth]);
            } else {
                Alert::error('Sorry', 'User not found 😭');
                return back();
            }
        }
    }
    public function updatePassword($id)
    {

        $validation = request()->validate([
            "username" => "required",
            "email" => "required",
            "password" => ['required', 'string', 'confirmed', new IsValidPassword()],
            // "image"=>"required",
        ]);
        if ($validation) {
            $update = User::find($id);
            $password = $validation["password"];
            $update->name = $validation["username"];
            $update->email = $validation["email"];
            $update->password = Hash::make($password);
            $update->update();
            // Alert::success('Successfully Chaged!', 'Please Sign in');
            Alert::success('Successfully Changed!');
            return redirect()->route('login');
        } else {
            return back()->withErrors($validation);
        }
    }
}