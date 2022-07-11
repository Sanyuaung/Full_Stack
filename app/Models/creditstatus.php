<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class creditstatus extends Model
{
    use HasFactory;
    public $connection="mysql2";
    public $table="CZ_CARD";

    public static function data(Request $req)
    {
        $validation=$req->validate([
            "month"=>"required",
        ]);
        $year=substr($req->month, 0, 4);
        $month=substr($req->month, 5, 2);
        $date=$year.$month;
        // dd($date);
        if ($validation) {
            DB::connection('mysql2')->statement(DB::raw('set @row:=0'));
            $creditstatus = DB::connection('mysql2')->select("select @row:=@row + 1 AS NO,A.CARD_CUST_ID,A.CARD_EMBOSSED_NAME,A.CARD_BS_IND,C.ACCGRPLMT_CREDIT_LMT ,
            COALESCE(B.CSTMTACCT_ACCT_BAL, 0) AS CLOSE_BALANCE,B.CSTMTACCT_CURR_AGE_CODE,A.CARD_CARDPLAN_ID,
            A.CARD_PLASTIC_CODE,B.CSTMTACCT_YYYYMM
            FROM CZ_CARD A, CZ_CSTMTACCT B, CZ_ACCGRPLMT C
            WHERE A.CARD_CRDACCT_NO = B.CSTMTACCT_ACCT_NO
            AND A.CARD_CUST_ID = C.ACCGRPLMT_CUST_ID
            AND B.CSTMTACCT_YYYYMM=$date
            GROUP BY A.CARD_NO");
            // dd($co);
            return $creditstatus;
        }
    }
}