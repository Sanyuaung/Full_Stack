<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use App\Imports\merchantImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExcelImportController extends Controller
{
    public function import()
    {
        return view('import');
    }
    public function delete()
    {
        DB::delete('delete from merchants');
        Alert::success('Success Deleted');
        return back();
    }
    public function importfile(Request $request)
    {
        $validation=request()->validate([
            "file"=>"required|mimes:xlsx",
        ]);
            if ($request->file('file')) {
                $import =  Excel::import(new merchantImport, request()->file('file'));
                if ($import) {
                    Alert::success('Data Uploaded Succesfully!');
                    return back();
                } else {
                    Alert::error('Data Uploaded failed!');
                    return back();
                }
            }else {
                Alert::error('please choose your file!');
                return back();
            }
        
    }
}