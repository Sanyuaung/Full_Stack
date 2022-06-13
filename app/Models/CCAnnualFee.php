<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CCAnnualFee extends Model
{
    use HasFactory;
    public static function data(Request $req)
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
        if ($validation) {
            DB::connection('mysql2')->statement(DB::raw('set @row:=0'));
            $annual= DB::connection('mysql2')->select("select CARD_CUST_ID, CARD_EMBOSSED_NAME, CARD_TYPE, CARD_CRDACCT_NO, 
                    CARD_BS_IND, CARD_PLASTIC_CODE, B.CRDACCT_STATUS_ID, B.CRDACCT_AGE_CODE, CARD_PLASTIC_DATE,CARD_APP_DATE,
                    CARD_EXPIRY_CCYYMM from CZ_CARD A, CZ_CRDACCT B, CZ_AUTHTXN C
                    where A.CARD_CRDACCT_NO = B.CRDACCT_NO
                    and A.CARD_NO = C.AUTHTXN_CARD_NO
                    and A.CARD_TYPE like 'C'
                    and substring(CARD_APP_DATE,5,2) like '$month1'
                    and A.CARD_PLASTIC_CODE like 'A'
                    and B.CRDACCT_STATUS_ID like 'A'
                    group by CARD_CUST_ID, CARD_EMBOSSED_NAME, CARD_TYPE, CARD_CRDACCT_NO,
                    CARD_BS_IND, CARD_PLASTIC_CODE, B.CRDACCT_STATUS_ID, B.CRDACCT_AGE_CODE, CARD_PLASTIC_DATE,CARD_APP_DATE,
                    CARD_EXPIRY_CCYYMM, C.AUTHTXN_CARD_NO having max(C.AUTHTXN_REQUEST_DATE) < $date2");
        // dd($co);
            return $annual;
        }
    }
}