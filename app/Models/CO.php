<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CO extends Model
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
            $co = DB::connection('mysql2')->select("select $date as date,@row:=@row + 1 AS NO, F.CUST_ID,F.CUST_NAME,C.CONTACT_NAME, 
            C.CONTACT_BIRTH_DATE, C.CONTACT_IC,C.CONTACT_MOBILE,
            C.CONTACT_EMPLOYER_NAME, C.CONTACT_STAFF, A.CARD_BRANCH_ID AS CUST_BRANCH_ID,
            B.CSTMTACCT_ACCT_NO as ACCOUNT_NO,B.CSTMTACCT_YYYYMM AS STMT_MONTH, B.CSTMTACCT_CURRENCY AS CURRENCY,
            COALESCE(B.CSTMTACCT_ACCT_OPEN_BAL, 0) AS OPEN_BALANCE, E.ACCGRPLMT_CREDIT_LMT,
            COALESCE(B.CSTMTACCT_ACCT_BAL, 0) AS CLOSE_BALANCE,B.CSTMTACCT_CURR_AGE_CODE AS CURR_AGE_CODE, 
            CONCAT(CUST_STATUS_ID, '-', STS_NAME) AS STATUS
            FROM  CZ_CARD A
            INNER JOIN CZ_CUSTOMER F ON A.CARD_CUST_ID = F.CUST_ID
            INNER JOIN CZ_CSTMTACCT B ON B.CSTMTACCT_ACCT_NO =A.CARD_CRDACCT_NO 
            AND B.CSTMTACCT_CUST_ID=F.CUST_ID AND B.CSTMTACCT_CRDR_IND='C' AND B.CSTMTACCT_YYYYMM='$date'
            INNER JOIN CZ_ACCGRPLMT E ON E.ACCGRPLMT_CUST_ID=A.CARD_CUST_ID 
            LEFT JOIN CZ_CONTACT C ON C.CONTACT_ID=F.CUST_ID AND CONTACT_OF='CS' AND CONTACT_TYPE_ID='MAIN' 
            LEFT JOIN CZ_STATUS D ON STS_ID=CUST_STATUS_ID
            GROUP BY B.CSTMTACCT_ACCT_NO ORDER BY A.CARD_BRANCH_ID ASC");
            // dd($co);
            return $co;
        }
    }
}