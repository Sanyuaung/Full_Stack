<?php

namespace App\Http\Controllers;

use App\Exports\AtmExport;
use App\Exports\cardlistExport;
use App\Exports\CCAnnualFeeExport;
use App\Exports\COExport;
use App\Exports\creditstatusExport;
use App\Exports\OnusExport;
use App\Models\Atm;
use App\Models\cardlist;
use App\Models\CCAnnualFee;
use App\Models\CO;
use App\Models\creditstatus;
use App\Models\onus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class onecardController extends Controller
{
    public function atmhome()
    {
        return view('NewSwitch/Reports/ATM/atmhome');
    }
    public function atmprint(Request $req)
    {
        // dd($req->start);
        $validation=$req->validate([
            "start"=>"required",
            "end"=>"required",
        ]);
        $startdate=substr($req->start, 0, 4).substr($req->start, 5, 2).substr($req->start, 8, 2);
        $enddate=substr($req->end, 0, 4).substr($req->end, 5, 2).substr($req->end, 8, 2);
        $data=new Atm();
        $atm=$data->data($req);
        return view('NewSwitch/Reports/ATM/atmshow', ['atm'=>$atm,'startdate'=>$startdate,'enddate'=>$enddate]);
    }
    public function atmdownload($startdate, $enddate)
    {
        $count1=substr($startdate, 6, 2);
        $count2=substr($enddate, 6, 2);
        $count=(($count2-$count1)+1)*24;
        // dd($count);
        return Excel::download(new AtmExport($startdate, $enddate, $count), "ATM Performance From $startdate to $enddate.xlsx");
    }

    public function cohome()
    {
        return view('NewSwitch/Reports/Outstanding/Cohome');
    }

    public function coprint(Request $req)
    {
        $validation=$req->validate([
            "month"=>"required",
        ]);
        $year=substr($req->month, 0, 4);
        $month=substr($req->month, 5, 2);
        $date=$year.$month;
        $data=new CO();
        $co=$data->data($req);
        // dd($co);
        return view('NewSwitch/Reports/Outstanding/Coshow', ['co'=>$co,'date'=>$date]);
    }

    public function codownload($date)
    {
        return Excel::download(new COExport($date), "Customer Outstanding list for $date.xlsx");

    }

    public function annualfeehome()
    {
        return view('NewSwitch/Reports/CreditCard_AnnualFee/AnnualFeeHome');
    }

    public function AnnualFeePrint(Request $req)
    {
        $validation=$req->validate([
            "month"=>"required",
        ]);
        $year1=substr($req->month, 0, 4);
        $month1=substr($req->month, 5, 2);
        $date1=$year1.$month1;
        $year2=substr($req->month, 0, 4)-1;
        $month=substr($req->month, 5, 2)+"01";
        $month2="0".$month;
        $date2=$year2.$month2."01";
        $data=new CCAnnualFee();
        $annual=$data->data($req);
        // dd($month1);
        return view('NewSwitch/Reports/CreditCard_AnnualFee/AnnualFeeShow', 
        ['annual'=>$annual,'month1'=>$month1,'date1'=>$date1,'date2'=>$date2]);        
    }

    public function AnnualFeedownload($month1, $date2, $date1)
    {
        // dd($date2);
        return Excel::download(new CCAnnualFeeExport($month1, $date2, $date1), "$date1 Credit Card Annual Fee (Not Using Withing 1 year).xlsx");
    }
    public function cardhome()
    {
        return view('NewSwitch/Reports/MOB_Card_List/cardhome');
    }
    public function cardprint(Request $req)
    {
        $validation=$req->validate([
            "startdate"=>"required",
            "enddate"=>"required",
            "brand"=>"required",
        ]);
        $brand=$req->brand;
        $startdate=substr($req->startdate, 0, 4).substr($req->startdate, 5, 2).substr($req->startdate, 8, 2);
        $enddate=substr($req->enddate, 0, 4).substr($req->enddate, 5, 2).substr($req->enddate, 8, 2);
        if ($req->brand==='MPU_DEBIT') {
            $MPU_DEBIT=new cardlist();
            $db =$MPU_DEBIT->MPU_DEBIT($req);
            // dd($db);
        return view('NewSwitch/Reports/MOB_Card_List/cardshow', ['db'=>$db,'startdate'=>$startdate,'enddate'=>$enddate,
        'brand'=>$req->brand]);
        }else{
            $MOB_UPI_DB=new cardlist();
            $db =$MOB_UPI_DB->MOB_UPI_DB($req);
            // dd($db);
        return view('NewSwitch/Reports/MOB_Card_List/cardshow', ['db'=>$db,'startdate'=>$startdate,'enddate'=>$enddate,
        'brand'=>$brand]);   
        }
    }
    public function cardlistdownload($startdate, $enddate,$brand)
    {
        // dd($date2);
        return Excel::download(new cardlistExport($startdate, $enddate,$brand), "$brand CardList ($startdate to $enddate).xlsx");
    }
    public function onushome()
    {
        return view('NewSwitch/Reports/Acquiring_Onus/onushome');
    }
    public function onusprint(Request $req)
    {
        $validation=$req->validate([
            "startdate"=>"required",
            "enddate"=>"required",
        ]);
        $startdate=substr($req->startdate, 0, 4).substr($req->startdate, 5, 2).substr($req->startdate, 8, 2);
        $enddate=substr($req->enddate, 0, 4).substr($req->enddate, 5, 2).substr($req->enddate, 8, 2);
        $onus=new onus();
        $db =$onus->onus($req);
        // dd($db);
        return view('NewSwitch/Reports/Acquiring_Onus/onushow', ['db'=>$db,'startdate'=>$startdate,'enddate'=>$enddate]); 
    }
    public function onusdownload($startdate, $enddate)
    {
        // dd($date2);
        return Excel::download(new OnusExport($startdate, $enddate), "Acquiring Report ($startdate to $enddate).xlsx");
    }
    public function credithome()
    {
        return view('NewSwitch/Reports/MOB_Credit_Status/credithome');
    }
    public function creditlistprint(Request $req)
    {
        $validation=$req->validate([
            "month"=>"required",
        ]);
        $year=substr($req->month, 0, 4);
        $month=substr($req->month, 5, 2);
        $date=$year.$month;
        $data=new creditstatus();
        $creditstatus=$data->data($req);
        // dd($creditstatus);
        return view('NewSwitch/Reports/MOB_Credit_Status/creditshow', ['cr'=>$creditstatus,'date'=>$date]);
    }
    public function creditdownload($date)
    {
        return Excel::download(new creditstatusExport($date), "Credit Card Stauts ($date).xlsx");

    }
}