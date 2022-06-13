<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\PSSD01Export;
use App\Exports\PSSD02Export;
use App\Exports\PSSD04Export;
use App\Models\PSSD01;
use App\Models\PSSD02;
use App\Models\PSSD04;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
class CBMController extends Controller
{
    
    public function pssd01home()
    {
        return view('NewSwitch/Reports/CBM_Reports/PSSD_01/pssd01home');
    }
    public function pssd01print(Request $req)
    {
        $validation=$req->validate([
            "date"=>"required",
        ]);
        $date=substr($req->date, 0, 4).substr($req->date, 5, 2).substr($req->date, 8, 2);
        $data=new PSSD01();
        $pssd01=$data->data($req);
        // dd($pssd01);
        return view('NewSwitch/Reports/CBM_Reports/PSSD_01/pssd01print', ['pssd01'=>$pssd01,'date'=>$date]);
    }
    public function pssd01download($date){
        return Excel::download(new PSSD01Export($date), "PSSD_01($date).xlsx");
    }
    public function pssd04home(){
        return view('NewSwitch/Reports/CBM_Reports/PSSD_04/pssd04home');
    }
    public function pssd04print(Request $req)
    {
        $validation=$req->validate([
            "date"=>"required",
        ]);
        $date=substr($req->date, 0, 4).substr($req->date, 5, 2).substr($req->date, 8, 2);
        $data=new PSSD04();
        $pssd04=$data->data($req);
        // dd($pssd04);
        return view('NewSwitch/Reports/CBM_Reports/PSSD_04/pssd04print', ['pssd04'=>$pssd04,'date'=>$date]);
    }
    public function pssd04download($date){
        return Excel::download(new PSSD04Export($date), "PSSD_04($date).xlsx");
    }
    public function pssd02home()
    {
        return view('NewSwitch/Reports/CBM_Reports/PSSD_02/pssd02home');
    }
    public function pssd02print(Request $req)
    {
        $validation=$req->validate([
            "date"=>"required",
        ]);
        $date=substr($req->date, 0, 4).substr($req->date, 5, 2).substr($req->date, 8, 2);
        $data=new PSSD02();
        $pssd02=$data->data($req);
        // dd($pssd02);
        return view('NewSwitch/Reports/CBM_Reports/PSSD_02/pssd02print', ['pssd02'=>$pssd02,'date'=>$date]);
    }
    public function pssd02download($date){
        return Excel::download(new PSSD02Export($date), "PSSD_02($date).xlsx");
    }
}