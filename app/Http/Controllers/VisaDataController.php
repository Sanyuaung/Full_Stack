<?php

namespace App\Http\Controllers;

use App\Exports\VisaExport;
use App\Models\syavisatran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;

class VisaDataController extends Controller
{
    public function visa()
    {
        return view('NewSwitch/VISA/visa');
    }

    public function insert(Request $req)
    {
        $validation=$req->validate([
            'settledate'=> "required",
            'num'=>"required",
            'usd'=>"required",
            'mmk'=>"required",
            'Net'=>"required",
            'rate'=>"required",
            'commAmt'=>"required",
            'typeOfTrans'=>"required",
            'cardType'=>"required",
            'currency'=>"required",
            'country'=>"required"
        ]);
        $Year=substr($req->settledate, 0, 4);
        $Month=substr($req->settledate, 5, 2);
        $Date=substr($req->settledate, 8, 2);
        $Year1=substr($req->fundingDate, 0, 4);
        $Month1=substr($req->fundingDate, 5, 2);
        $Date1=substr($req->fundingDate, 8, 2);
        // dd($req->settledate);
        $settledate=$Year.$Month.$Date;
        $fundingDate=$Year1.$Month1.$Date1;
        if ($validation) {
            //insert data to DB
            $tranx=new syavisatran();
            $tranx->settleDate=$settledate;
            $tranx->noTrans=$req->num;
            $tranx->usdAmt=$req->usd;
            $tranx->mmkAmt=$req->mmk;
            $tranx->exRate=$req->rate;
            $tranx->netAmt=$req->Net;
            $tranx->settAmt_Nostro_USD=!empty($req->settAmt_Nostro_USD) ? $req->settAmt_Nostro_USD : '';
            $tranx->fundingDate=!empty($fundingDate) ? $fundingDate : '';
            $tranx->typeOfTrans=$req->typeOfTrans;
            $tranx->commAmt=$req->commAmt;
            $tranx->cardType=$req->cardType;
            $tranx->currency=$req->currency;
            $tranx->country=$req->country;
            $tranx->save();
            Alert::success('Sucessfully added');
            return back();
        } else {
            return back()->withErrors($validation);
        }
    }

    public function show()
    {
        $tranx=syavisatran::latest()->paginate(10); // latest to first
        return view('NewSwitch/VISA/showall', ['tranxs'=>$tranx]);
    }
    public function visaedit($id){
        $edittran=syavisatran::find($id);
        $Y=substr($edittran->settleDate, 0, 4); // YYYY
        $M=substr($edittran->settleDate, 4, 2); // MM
        $D=substr($edittran->settleDate, 6, 2); // MM
        $settledate=$Y."-".$M."-".$D;
        // dd($settledate);
        // dd($Y,$M,$D);
        return view("NewSwitch/VISA/visaedit",['edittran'=>$edittran,'settledate'=>$settledate]) ;
    }
    public function visaupdate($id){
        $validation=request()->validate([
            'settledate'=> "required",
            'num'=>"required",
            'usd'=>"required",
            'mmk'=>"required",
            'Net'=>"required",
            'settAmt_Nostro_USD'=>"required",
            'fundingDate'=>'required|max:8',
            'rate'=>"required",
            'commAmt'=>"required",
            'cardType'=>"required",
            'currency'=>"required",
            'country'=>"required",
            'typeOfTrans'=>"required",
        ]);
        // dd($validation);
        if($validation){        
            // $Year=substr($validation["settledate"], 0, 4);
            // $Month=substr($validation["settledate"], 5, 2);
            // $Date=substr($validation["settledate"], 8, 2);
            // $Year1=substr($validation["fundingDate"], 0, 4);
            // $Month1=substr($validation["fundingDate"], 5, 2);
            // $Date1=substr($validation["fundingDate"], 8, 2);
        // dd($req->settledate);
            // $settledate=$Year.$Month.$Date;
            // $fundingDate=$Year1.$Month1.$Date1;
            $vidaupdate=syavisatran::find($id);
            $vidaupdate->settleDate=$validation["settledate"];
            $vidaupdate->noTrans=$validation["num"];
            $vidaupdate->usdAmt=$validation["usd"];
            $vidaupdate->mmkAmt=$validation["mmk"];
            $vidaupdate->exRate=$validation["rate"];
            $vidaupdate->netAmt=$validation["Net"];
            $vidaupdate->settAmt_Nostro_USD=!empty($validation["settAmt_Nostro_USD"]) ? $validation["settAmt_Nostro_USD"] : '';
            $vidaupdate->fundingDate=!empty($validation["fundingDate"]) ? $validation["fundingDate"] : '';
            $vidaupdate->commAmt=$validation["commAmt"];
            $vidaupdate->cardType=$validation["cardType"];
            $vidaupdate->currency=$validation["currency"];
            $vidaupdate->typeOfTrans=$validation["typeOfTrans"];
            $vidaupdate->country=$validation["country"];
            $vidaupdate->update();
            Alert::success('Updated','updated successfully');
            return redirect()->route('showall');
        }else{
            return back()->withErrors($validation);
        }
    }
    
    public function ccy()
    {
        $data=json_decode(file_get_contents('http://forex.cbm.gov.mm/api/latest'),true);
        return view('NewSwitch/VISA/currency',['data'=>$data['rates']['USD']]);
    }

    public function ccyinsert(Request $req)
    {
        $validation=$req->validate([
            'date'=> "required",
            'rate'=>"required",
            'ccy'=>"required",
        ]);
        $Year=substr($req->date, 0, 4);
        $Month=substr($req->date, 5, 2);
        $Date=substr($req->date, 8, 2);
        // dd($Year.$Month.$Date);
        $date=$Year.$Month.$Date;
        if ($validation) {
            DB::statement(DB::raw('set @row:=0'));
            $a=DB::connection('mysql2')->select("select CurrencyDate from KCN_EXCHANGE where CurrencyDate=$date");
            if (empty($a)) {
                DB::connection('mysql2')->select("insert into KCN_EXCHANGE (CurrencyDate,CURRENCY_CODE,MarketRate) VALUES ('$date','$req->ccy','$req->rate')");
                Alert::success('Sucessfully added');
                return back();
            } elseif ($a[0]->CurrencyDate=$date) {
                Alert::info('Already Imported');
                return back();
            } else {
                return back()->withErrors($validation);
            }
        }
    }
    public function visadownload(Request $req)
    {
        $validation=$req->validate([
            "startdate"=>"required",
            "enddate"=>"required",
        ]); 
        $startyear=substr($req->startdate, 0, 4);
        $startmonth=substr($req->startdate, 5, 2);
        $startd=substr($req->startdate, 8, 2);
        $endyear=substr($req->enddate, 0, 4);
        $endmonth=substr($req->enddate, 5, 2);
        $endd=substr($req->enddate, 8, 2);
        $startdate=$startyear.$startmonth.$startd;
        $enddate=$endyear.$endmonth.$endd;
        return Excel::download(new VisaExport($startdate, $enddate), "Visa Data from $startdate to $enddate.xlsx");

    }
}