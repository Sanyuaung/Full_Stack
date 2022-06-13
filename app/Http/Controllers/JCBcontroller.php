<?php

namespace App\Http\Controllers;

use App\Exports\DataExport;
use App\Models\jcb;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class JCBcontroller extends Controller
{
    public function jcb()
    {
        $validation=request()->validate([
            "jcb"=>"required",
        ]);
        $name=request('jcb');
        $filename=$name->getClientoriginalName();
        $e=substr($filename, 0, 7);
        if ($e==="JCB_CLR") {
            $files=file(request('jcb')->getRealPath());
            $data=(array_slice($files, 0));
            $parts =(array_chunk($data, 5000));
            foreach ($parts as $part) {
                $name=request('jcb');
                $filename=$name->getClientoriginalName();
                $fileName=uniqid()."_".$name->getClientoriginalName();
                $fileSave=resource_path('file/jcb/'.'JCB'.$fileName.'.txt');
                file_put_contents($fileSave, $part);
            }
            $path=$fileSave;
            $filePath=glob($path);
            foreach ($filePath as $file) {
                $data=array_map('str_getcsv', file($file));
                DB::delete('delete from jcbs');
                foreach ($data as $row) {
                    jcb::Create([
                                    'Field1'=>$row [0],
                                    'filename'=>$filename,
                                ]);
                };
            }
            $data=new jcb();
            return view('jcbupload', [
                        'users' => $data->show(),
                        'one'   => $data->total1(),
                        'two'   => $data->total2(),
                        'three'   => $data->total3(),
                        'four'   => $data->total4(),
                        'filename'=>$filename,
                    ]);
        } else {
            Alert::error('Error', 'Doesn\'t work this file');
            return back();
        }
    }
    public function download()
    {
        $data=new jcb();
        $users=$data->show();
        foreach ($users as $user) {
            $filename = "JCB".$user->date.'.xlsx';
        }
        return Excel::download(new DataExport, $filename);
    }
}