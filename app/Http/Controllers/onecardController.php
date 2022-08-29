<?php

namespace App\Http\Controllers;

use App\Exports\AtmExport;
use App\Exports\cardlistExport;
use App\Exports\AnnualFeeListingExport;
use RealRashid\SweetAlert\Facades\Alert;
use App\Exports\COExport;
use App\Exports\creditstatusExport;
use App\Exports\MerchantExport;
use App\Exports\OnusExport;
use App\Exports\SaleEcomByAmtExport;
use App\Exports\SaleEcomAllExport;
use App\Exports\SaleEcomBetweenExport;
use App\Models\Atm;
use App\Models\cardlist;
use App\Models\AnnualFeeListing;
use App\Models\CO;
use App\Models\creditstatus;
use App\Models\onus;
use App\Models\Trans;
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
        $validation = $req->validate([
            "start" => "required",
            "end" => "required",
        ]);
        $startdate = substr($req->start, 0, 4) . substr($req->start, 5, 2) . substr($req->start, 8, 2);
        $enddate = substr($req->end, 0, 4) . substr($req->end, 5, 2) . substr($req->end, 8, 2);
        $data = new Atm();
        $atm = $data->data($req);
        return view('NewSwitch/Reports/ATM/atmshow', ['atm' => $atm, 'startdate' => $startdate, 'enddate' => $enddate]);
    }
    public function atmdownload($startdate, $enddate)
    {
        $count1 = substr($startdate, 6, 2);
        $count2 = substr($enddate, 6, 2);
        $count = (($count2 - $count1) + 1) * 24;
        // dd($count);
        return Excel::download(new AtmExport($startdate, $enddate, $count), "ATM Performance From $startdate to $enddate.xlsx");
    }

    public function cohome()
    {
        return view('NewSwitch/Reports/Outstanding/Cohome');
    }

    public function coprint(Request $req)
    {
        $validation = $req->validate([
            "month" => "required",
            "branch" => "required",
        ]);
        $branch = $req->branch;
        $year = substr($req->month, 0, 4);
        $month = substr($req->month, 5, 2);
        $date = $year . $month;
        $data = new CO();
        $co = $data->data($req);
        // dd($co);
        return view('NewSwitch/Reports/Outstanding/Coshow', ['co' => $co, 'date' => $date, 'branch' => $branch]);
    }

    public function codownload($date, $branch)
    {
        return Excel::download(new COExport($date, $branch), "Customer Outstanding list for $date ($branch Branch).xlsx");
    }

    public function AnnualFeeListingHome()
    {
        return view('NewSwitch/Reports/CreditCard_AnnualFee/AnnualFeeListingHome');
    }

    public function AnnualFeeListingPrint(Request $req)
    {
        $validation = $req->validate([
            "month" => "required",
            "card" => "required",
        ]);
        $month = $req->month;
        $card = $req->card;
        if ($card === 'MPU_CLASSIC') {
            $data = new AnnualFeeListing();
            $MPU_CLASSIC = $data->MPU_CLASSIC($req);
            // dd($MPU_CLASSIC);
            return view(
                'NewSwitch/Reports/CreditCard_AnnualFee/AnnualFeeListingShow',
                ['month' => $month, 'card' => $card, 'datas' => $MPU_CLASSIC]
            );
        } elseif ($card === 'MPU_GOLD') {
            $data = new AnnualFeeListing();
            $MPU_GOLD = $data->MPU_GOLD($req);
            // dd($MPU_GOLD);
            return view(
                'NewSwitch/Reports/CreditCard_AnnualFee/AnnualFeeListingShow',
                ['month' => $month, 'card' => $card, 'datas' => $MPU_GOLD]
            );
        } elseif ($card === 'UPI_GOLD') {
            $data = new AnnualFeeListing();
            $UPI_GOLD = $data->UPI_GOLD($req);
            // dd($UPI_GOLD);
            return view(
                'NewSwitch/Reports/CreditCard_AnnualFee/AnnualFeeListingShow',
                ['month' => $month, 'card' => $card, 'datas' => $UPI_GOLD]
            );
        } elseif ($card === 'UPI_PLT') {
            $data = new AnnualFeeListing();
            $UPI_PLT = $data->UPI_PLT($req);
            // dd($UPI_PLT);
            return view(
                'NewSwitch/Reports/CreditCard_AnnualFee/AnnualFeeListingShow',
                ['month' => $month, 'card' => $card, 'datas' => $UPI_PLT]
            );
        }
    }

    public function AnnualFeeListingDownload($month, $card)
    {
        // dd($date2);
        return Excel::download(new AnnualFeeListingExport($month, $card), "Credit Card AnnualFeel Listing of $card in $month Month.xlsx");
    }
    public function cardhome()
    {
        return view('NewSwitch/Reports/MOB_Card_List/cardhome');
    }
    public function cardprint(Request $req)
    {
        $validation = $req->validate([
            "startdate" => "required",
            "enddate" => "required",
            "brand" => "required",
        ]);
        $brand = $req->brand;
        $startdate = substr($req->startdate, 0, 4) . substr($req->startdate, 5, 2) . substr($req->startdate, 8, 2);
        $enddate = substr($req->enddate, 0, 4) . substr($req->enddate, 5, 2) . substr($req->enddate, 8, 2);
        if ($req->brand === 'MPU_DEBIT') {
            $MPU_DEBIT = new cardlist();
            $db = $MPU_DEBIT->MPU_DEBIT($req);
            // dd($db);
            return view('NewSwitch/Reports/MOB_Card_List/cardshow', [
                'db' => $db, 'startdate' => $startdate, 'enddate' => $enddate,
                'brand' => $req->brand
            ]);
        } else {
            $MOB_UPI_DB = new cardlist();
            $db = $MOB_UPI_DB->MOB_UPI_DB($req);
            // dd($db);
            return view('NewSwitch/Reports/MOB_Card_List/cardshow', [
                'db' => $db, 'startdate' => $startdate, 'enddate' => $enddate,
                'brand' => $brand
            ]);
        }
    }
    public function cardlistdownload($startdate, $enddate, $brand)
    {
        // dd($date2);
        return Excel::download(new cardlistExport($startdate, $enddate, $brand), "$brand CardList ($startdate to $enddate).xlsx");
    }
    public function onushome()
    {
        return view('NewSwitch/Reports/Acquiring_Onus/onushome');
    }
    public function onusprint(Request $req)
    {
        $validation = $req->validate([
            "startdate" => "required",
            "enddate" => "required",
        ]);
        $startdate = substr($req->startdate, 0, 4) . substr($req->startdate, 5, 2) . substr($req->startdate, 8, 2);
        $enddate = substr($req->enddate, 0, 4) . substr($req->enddate, 5, 2) . substr($req->enddate, 8, 2);
        $onus = new onus();
        $db = $onus->onus($req);
        // dd($db);
        return view('NewSwitch/Reports/Acquiring_Onus/onushow', ['db' => $db, 'startdate' => $startdate, 'enddate' => $enddate]);
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
        $validation = $req->validate([
            "month" => "required",
        ]);
        $year = substr($req->month, 0, 4);
        $month = substr($req->month, 5, 2);
        $date = $year . $month;
        $data = new creditstatus();
        $creditstatus = $data->data($req);
        // dd($creditstatus);
        return view('NewSwitch/Reports/MOB_Credit_Status/creditshow', ['cr' => $creditstatus, 'date' => $date]);
    }
    public function creditdownload($date)
    {
        return Excel::download(new creditstatusExport($date), "Credit Card Stauts ($date).xlsx");
    }
    public function export()
    {
        return Excel::download(new MerchantExport, "Merchant Lists.xlsx");
    }
    public function SaleEcomHome()
    {
        return view('NewSwitch/Reports/Transactions/SaleEcomHome');
    }
    public function SaleEcomAll()
    {
        return view('NewSwitch/Reports/Transactions/SaleEcomAll');
    }
    public function SaleEcomAllprint(Request $req)
    {
        $validation = $req->validate([
            "trans" => "required",
            "start" => "required",
            "end" => "required",
        ]);
        $startdate = substr($req->start, 8, 2);
        $startmonth = substr($req->start, 5, 2);
        $startyear = substr($req->start, 0, 4);
        $start = $startyear . $startmonth . $startdate;
        $enddate = substr($req->end, 8, 2);
        $endmonth = substr($req->end, 5, 2);
        $endyear = substr($req->end, 0, 4);
        $end = $endyear . $endmonth . $enddate;
        $type = $req->trans;
        $data = new Trans();
        $trans = $data->trans($req);
        // dd($trans);
        return view('NewSwitch/Reports/Transactions/SaleEcomAllPrint', ['trans' => $trans, 'type' => $type, 'start' => $start, 'end' => $end,]);
    }
    public function SaleEcomAllExport($type, $start, $end)
    {
        return Excel::download(
            new SaleEcomAllExport($type, $start, $end),
            "$type All Transactions (From $start to $end).xlsx"
        );
    }
    public function SaleEcomByAmt()
    {
        return view('NewSwitch/Reports/Transactions/SaleEcomByAmt');
    }
    public function SaleEcomByAmtprint(Request $req)
    {
        $validation = $req->validate([
            "trans" => "required",
            "start" => "required",
            "end" => "required",
        ]);
        $startdate = substr($req->start, 8, 2);
        $startmonth = substr($req->start, 5, 2);
        $startyear = substr($req->start, 0, 4);
        $start = $startyear . $startmonth . $startdate;
        $enddate = substr($req->end, 8, 2);
        $endmonth = substr($req->end, 5, 2);
        $endyear = substr($req->end, 0, 4);
        $end = $endyear . $endmonth . $enddate;
        $type = $req->trans;
        $reqamt1 = $req->reqamt1;
        $reqamt2 = $req->reqamt2;
        $sign = $req->sign;
        if ($sign == 'All') {
            $data = new Trans();
            $alltrans = $data->alltrans($req);
            return view(
                'NewSwitch/Reports/Transactions/SaleEcomAllPrint',
                ['trans' => $alltrans, 'type' => $type, 'start' => $start, 'end' => $end, 'sign' => $sign]
            );
        } else if ($sign == 'gt') {
            $data = new Trans();
            $GreaterThan = $data->GreaterThan($req);
            return view(
                'NewSwitch/Reports/Transactions/SaleEcomByAmtPrint',
                ['trans' => $GreaterThan, 'type' => $type, 'start' => $start, 'end' => $end, 'sign' => $sign, 'reqamt1' => $reqamt1]
            );
        } else if ($sign == 'lt') {
            $data = new Trans();
            $LessThan = $data->LessThan($req);
            return view(
                'NewSwitch/Reports/Transactions/SaleEcomByAmtPrint',
                ['trans' => $LessThan, 'type' => $type, 'start' => $start, 'end' => $end, 'sign' => $sign, 'reqamt1' => $reqamt1]
            );
        } else if ($sign == 'ge') {
            $data = new Trans();
            $ge = $data->ge($req);
            return view(
                'NewSwitch/Reports/Transactions/SaleEcomByAmtPrint',
                ['trans' => $ge, 'type' => $type, 'start' => $start, 'end' => $end, 'sign' => $sign, 'reqamt1' => $reqamt1]
            );
        } else if ($sign == 'le') {
            $data = new Trans();
            $le = $data->le($req);
            return view(
                'NewSwitch/Reports/Transactions/SaleEcomByAmtPrint',
                ['trans' => $le, 'type' => $type, 'start' => $start, 'end' => $end, 'sign' => $sign, 'reqamt1' => $reqamt1]
            );
        } else if ($sign == 'between') {
            $data = new Trans();
            $between = $data->between($req);
            return view(
                'NewSwitch/Reports/Transactions/SaleEcomBetweenPrint',
                [
                    'trans' => $between, 'type' => $type, 'start' => $start, 'end' => $end,
                    'sign' => $sign, 'reqamt1' => $reqamt1, 'reqamt2' => $reqamt2
                ]
            );
        }
    }
    public function SaleEcomByAmtExport($type, $start, $end, $reqamt1, $sign)
    {
        if ($sign == 'gt') {
            return Excel::download(
                new SaleEcomByAmtExport($type, $start, $end, $reqamt1, $sign),
                "$type Transactions greater than $reqamt1 (From $start to $end).xlsx"
            );
        } else if ($sign == 'lt') {
            return Excel::download(
                new SaleEcomByAmtExport($type, $start, $end, $reqamt1, $sign),
                "$type Transactions less than $reqamt1 (From $start to $end).xlsx"
            );
        } else if ($sign == 'ge') {
            return Excel::download(
                new SaleEcomByAmtExport($type, $start, $end, $reqamt1, $sign),
                "$type Transactions greater than equal $reqamt1 (From $start to $end).xlsx"
            );
        } else if ($sign == 'le') {
            return Excel::download(
                new SaleEcomByAmtExport($type, $start, $end, $reqamt1, $sign),
                "$type Transactions less than equal $reqamt1 (From $start to $end).xlsx"
            );
        }
    }
    public function SaleEcomBetweenExport($type, $start, $end, $reqamt1, $reqamt2, $sign)
    {
        return Excel::download(
            new SaleEcomBetweenExport($type, $start, $end, $reqamt1, $reqamt2, $sign),
            "$type Transactions between $reqamt1 and $reqamt2 (From $start to $end).xlsx"
        );
    }
}
