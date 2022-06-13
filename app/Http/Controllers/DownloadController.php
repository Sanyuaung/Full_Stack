<?php

namespace App\Http\Controllers;

use App\Exports\acomExport;
use App\Exports\icomExport;
use App\Exports\Inc11eExport;
use App\Exports\AerrExport;
use App\Exports\ierrExport;
use App\Exports\ijc01_900sExport;
use App\Exports\ijc01_902sExport;
use App\Exports\ijc01cExport;
use App\Exports\inc01cExport;
use App\Exports\inc11sExport;
use App\Exports\inc901Export;
use App\Exports\incExport;
use App\Exports\ind11cExport;
use App\Exports\indcExport;
use App\Exports\scom901902Export;
use App\Exports\scomExport;
use App\Models\acom;
use App\Models\aerr;
use App\Models\ierr;
use App\Models\inc11e;
use App\Models\icom;
use App\Models\ii_inc;
use App\Models\ii_scom;
use App\Models\ijc01_900;
use App\Models\ijc01_902;
use App\Models\ijc01c;
use App\Models\inc;
use App\Models\inc01c;
use App\Models\inc11s;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ind11c;
use App\Models\scom;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function downloadIND11c()
    {
        $data=new ind11c();
        $users=$data->ind11c();
        foreach ($users as $user) {
            $filename = $user->filename.'.xlsx';
        }
        return Excel::download(new ind11cExport, $filename);
    }
    public function downlodinc01c($name)
    {
        $data=new inc01c();
        $users=$data->inc01c();
        foreach ($users as $user) {
            $filename = $user->filename.'.xlsx';
        }
        return Excel::download(new inc01cExport($name), $filename);
    }

    public function downloadACOM()
    {
        $data=new acom();
        $users=$data->ACOM();
        foreach ($users as $user) {
            $filename = $user->filename.'.xlsx';
        }
        return Excel::download(new acomExport, $filename);
    }

    public function downloadICOM()
    {
        $data=new icom();
        $users=$data->ICOM();
        foreach ($users as $user) {
            $filename = $user->filename.'.xlsx';
        }
        return Excel::download(new icomExport, $filename);
    }

    public function downloadinc11s()
    {
        $data=new inc();
        $users=$data->inc11s();
        foreach ($users as $user) {
            $filename = $user->filename.'(Fund_Summary)'.'.xlsx';
        }
        return Excel::download(new incExport, $filename);
    }

    public function downloadinc11s_901()
    {
        $data=new ii_inc();
        $users=$data->inc11s_901();
        foreach ($users as $user) {
            $filename = $user->filename.'(Volume_Summary)'.'.xlsx';
        }
        return Excel::download(new inc901Export, $filename);
    }

    public function downloadincSCOM()
    {
        $data=new scom();
        $users=$data->scom();
        foreach ($users as $user) {
            $filename = $user->filename.'(Fund_Summary)'.'.xlsx';
        }
        return Excel::download(new scomExport, $filename);
    }

    public function downloadincSCOM_901902()
    {
        $data=new ii_scom();
        $users=$data->scom_901902();
        foreach ($users as $user) {
            $filename = $user->filename.'(Volume_Summary)'.'.xlsx';
        }
        return Excel::download(new scom901902Export, $filename);
    }

    public function downloadAerr()
    {
        $data=new aerr();
        $users=$data->aerr();
        foreach ($users as $user) {
            $filename = $user->filename.'.xlsx';
        }
        return Excel::download(new AerrExport, $filename);
    }

    public function downlodINC11E()
    {
        $data=new inc11e();
        $users=$data->inc11e();
        foreach ($users as $user) {
            $filename = $user->filename.'.xlsx';
        }
        return Excel::download(new Inc11eExport, $filename);
    }

    public function downlodIERR()
    {
        $data=new ierr();
        $users=$data->ierr();
        foreach ($users as $user) {
            $filename = $user->filename.'.xlsx';
        }
        return Excel::download(new ierrExport, $filename);
    }

    public function downlod01C()
    {
        $data=new ijc01c();
        $users=$data->ijc01c();
        foreach ($users as $user) {
            $filename = $user->filename.'.xlsx';
        }
        return Excel::download(new ijc01cExport, $filename);
    }

    public function downlodijc01_900()
    {
        $data=new ijc01_900();
        $users=$data->ijc01_900s();
        foreach ($users as $user) {
            $filename = $user->filename.'.xlsx';
        }
        return Excel::download(new ijc01_900sExport, $filename);
    }

    public function downlodijc01_902()
    {
        $data=new ijc01_902();
        $users=$data->ijc01_902();
        foreach ($users as $user) {
            $filename = $user->filename.'.xlsx';
        }
        
        return Excel::download(new ijc01_902sExport, $filename);
    }
}