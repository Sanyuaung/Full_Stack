<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function home(){
        $users=User::paginate(5);
        return view("admin.adminhome",['users'=>$users]);
    }
    public function edituser($id)
    {
        $edituser=User::find($id);
        return view("admin.edituser",['edituser'=>$edituser]) ;
    }
    public function editUpdateUser($id){
        $validation=request()->validate([
            'username'=>'required',
            'email'=>'required',
            'department'=>'required',
            'status'=>'required',
        ]);
        if($validation){
            $editUpdateUser=User::find($id);
            $editUpdateUser->name=$validation["username"];
            $editUpdateUser->email=$validation["email"];
            $editUpdateUser->department=$validation["department"];
            $editUpdateUser->status=$validation["status"];
            $editUpdateUser->update();
            Alert::success('Updated', $editUpdateUser->name.' is updated successfully');
            return redirect()->route('userhome');
        }else{
            return back()->withErrors($validation);
        }
    }
    function deleteUser($id)
    {
        $deleteUser=User::find($id);
        $deleteUser->delete();
        Alert::success('Deleted!', $deleteUser->name.' is deleted successfully');
        return back();
    }
}