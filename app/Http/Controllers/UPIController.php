<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ifc99cExport;
use App\Models\ifc99c;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class UPIController extends Controller
{
    public function UPIHome()
    {
        return view('UPISettlementHome');
    }
    public function UPIupload()
    {
        $validation = request()->validate([
            "upi" => "required|mimes:txt",
        ]);
        $name = request('upi');
        $name = request('upi');
        $filename = $name->getClientoriginalName();
        $a = substr($filename, 0, 3); //IFC
        $b = substr($filename, 9); //99c
        // dd($a,$b);
        if ($a == 'IFC' && $b === '99C') {
            $files = file(request('upi')->getRealPath());
            $count = array_pop($files);
            unset($count);
            $data = (array_slice($files, 1));
            if ($data == []) {
                Alert::error('This File is Empty.');
                return back();
            } else {
                $parts = (array_chunk($data, 5000));
                foreach ($parts as $part) {
                    $name = request('upi');
                    $filename = $name->getClientoriginalName();
                    $fileName = uniqid() . "_" . $name->getClientoriginalName();
                    $fileSave = resource_path('file/upi/99C/' . $fileName . '.txt');
                    file_put_contents($fileSave, $part);
                }
                $path = $fileSave;
                $filePath = glob($path);
                foreach ($filePath as $file) {
                    $data = array_map('str_getcsv', file($file));
                    DB::delete('delete from ifc99cs');
                    foreach ($data as $row) {
                        ifc99c::Create([
                            'Field1' => $row[0],
                            'filename' => $filename,
                        ]);
                    };
                }
                $data = new ifc99c();
                // dd($data->ifc99c());
                return view('NewSwitch/UPI/UPIupload', [
                    'ifc99c' => $data->ifc99c(),
                    'filename' => $filename,
                ]);
            };
        } else {
            Alert::error('Error', 'Doesn\'t work this file');
            return back();
        }
    }
    public function upidownload()
    {
        $data = new ifc99c();
        $users = $data->ifc99c();
        foreach ($users as $user) {
            $filename = $user->filename . '.xlsx';
        }
        return Excel::download(new ifc99cExport, $filename);
    }
}
