<?php


namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function JCBHome()
    {
        return view('JCBHome');
    }
    public function MPUHome()
    {
        return view('MPUHome');
    }

}