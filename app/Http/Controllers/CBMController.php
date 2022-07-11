<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
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
    public function pssd02input()
    {
        return view('NewSwitch/Reports/CBM_Reports/PSSD_02/pssdfilesinput');
    }
    public function fileinsert(Request $req)
    {
        $validation=$req->validate([
            "file"=>"required",
        ]);
        $name=request('file');
        $filename=$name->getClientoriginalName();
        // dd($filename);
        $a=substr($filename, 0, 3);
        $b=substr($filename, 9);
        $c=substr($filename, 11);
        // dd($c);
        if ($a=='INC' && $b==='01C' || $a=='IND' && $c==='ACOM' || $a=='IJC' && $b==='01C' || $a=='IUC' && $b==='01C') {
            $files=file(request('file')->getRealPath());
            $count=array_pop($files);
            unset($count);
            $data=(array_slice($files, 1));
            // dd($d)
            if ($data==[]) {
                Alert::error('This File is Empty.');
                return back();
            } else {
                $parts =(array_chunk($data, 5000));
                foreach ($parts as $part) {
                    $name=request('file');
                    $filename=$name->getClientoriginalName();
                    $fileName=uniqid()."_".$name->getClientoriginalName();
                    $fileSave=resource_path('file/mpu/11C/'.$fileName.'.txt');
                    file_put_contents($fileSave, $part);
                }
                $path=$fileSave;
                $filePath=glob($path);
                foreach ($filePath as $file) {
                    $data=array_map('str_getcsv', file($file));
                    foreach ($data as $row) {
                        if ($a=='INC' && $b==='01C') {
                            DB::connection('mysql2')->delete("delete from SYA_INC");
                            DB::connection('mysql2')->select("insert into SYA_INC (Field1)VALUES('$row[0]')");
                        } elseif ($a=='IND' && $c==='ACOM') {
                            DB::connection('mysql2')->delete("delete from SYA_ACOM");
                            DB::connection('mysql2')->select("insert into SYA_ACOM (Field1)VALUES('$row[0]')");
                        }elseif ($a=='IJC' && $b==='01C') {
                            DB::connection('mysql2')->delete("delete from SYA_IJC");
                            DB::connection('mysql2')->select("insert into SYA_IJC (Field1)VALUES('$row[0]')");
                        }elseif ($a=='IUC' && $b==='01C') {
                            DB::connection('mysql2')->delete("delete from SYA_IUC");
                            DB::connection('mysql2')->select("insert into SYA_IUC (Field1)VALUES('$row[0]')");
                        }
                    };
                }
                Alert::success('Complete');
                return back();
            };
        } else {
            Alert::error('Error', 'Doesn\'t work this file');
            return back();
        }
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