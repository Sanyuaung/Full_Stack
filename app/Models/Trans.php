<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Trans extends Model
{
    use HasFactory;
    public static function alltrans(Request $req)
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
        if ($validation) {
            DB::connection('mysql2')->statement(DB::raw('set @row:=0'));
            $alltrans = DB::connection('mysql2')->select("select  @row:=@row + 1 AS NO,AUTHTXN_CUST_ID, AUTHTXN_CARDHOLDER_NAME, AUTHTXN_CRDACCT_NO, AUTHTXN_REQUEST_AMT, count(AUTHTXN_REQUEST_AMT) as Tran_Count,
            (AUTHTXN_REQUEST_AMT*(count(AUTHTXN_REQUEST_AMT))) as Total,AUTHTXN_MERCHANT_NAME,
            AUTHTXN_TXNTYPE_ID,AUTHTXN_CRDPLAN_ID,AUTHTXN_REQUEST_DATE from CZ_AUTHTXN 
            where AUTHTXN_TXNTYPE_ID = '$type'
            and AUTHTXN_REQUEST_DATE between $start and $end
            group by AUTHTXN_CRDACCT_NO, AUTHTXN_MERCHANT_NAME, AUTHTXN_REQUEST_DATE, AUTHTXN_REQUEST_AMT
            order by NO asc");
            return $alltrans;
        }
    }
    public static function GreaterThan(Request $req)
    {
        $validation = $req->validate([
            "trans" => "required",
            "start" => "required",
            "reqamt1" => "required",
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
        $sign = $req->sign;
        DB::connection('mysql2')->statement(DB::raw('set @row:=0'));
        $GreaterThan = DB::connection('mysql2')->select("select DISTINCT  @row:=@row + 1 AS NO,fin.AUTHTXN_CUST_ID,fin.AUTHTXN_CARDHOLDER_NAME,fin.AUTHTXN_CRDACCT_NO,
                    fin.AUTHTXN_REQUEST_AMT,fin.Tran_Count, (fin.Tran_count*fin.AUTHTXN_REQUEST_AMT)as Total,
                    fin.AUTHTXN_MERCHANT_NAME,fin.AUTHTXN_TXNTYPE_ID,fin.AUTHTXN_CRDPLAN_ID,fin.AUTHTXN_REQUEST_DATE
                    from
                    (SELECT total.Total_Amt, tran_count.AUTHTXN_CUST_ID,tran_count.AUTHTXN_CARDHOLDER_NAME,tran_count.AUTHTXN_CRDACCT_NO,
                    tran_count.AUTHTXN_REQUEST_AMT,tran_count.Tran_count, (tran_count.Tran_count*tran_count.AUTHTXN_REQUEST_AMT)as Total,
                    tran_count.AUTHTXN_MERCHANT_NAME,tran_count.AUTHTXN_TXNTYPE_ID,tran_count.AUTHTXN_CRDPLAN_ID,tran_count.AUTHTXN_REQUEST_DATE
                    FROM
                    (select B.* from
                    (select A.Tran_count,A.AUTHTXN_CUST_ID ,A.AUTHTXN_CARDHOLDER_NAME,A.AUTHTXN_REQUEST_AMT, sum(total)as Total_Amt 
                    from(select *,count(AUTHTXN_REQUEST_AMT)as Tran_count,sum(AUTHTXN_REQUEST_AMT)as total from CZ_AUTHTXN
                    where AUTHTXN_TXNTYPE_ID = '$type'
                    and AUTHTXN_REQUEST_DATE between $start and $end
                    group by AUTHTXN_REQUEST_DATE,AUTHTXN_CRDACCT_NO, AUTHTXN_MERCHANT_NAME,AUTHTXN_REQUEST_AMT)A
                    group by AUTHTXN_REQUEST_DATE,AUTHTXN_CRDACCT_NO, AUTHTXN_MERCHANT_NAME)B)total,
                    (select AUTHTXN_CUST_ID, AUTHTXN_CARDHOLDER_NAME, AUTHTXN_CRDACCT_NO, AUTHTXN_REQUEST_AMT,
                    count(AUTHTXN_REQUEST_AMT)as Tran_count,AUTHTXN_MERCHANT_NAME,AUTHTXN_TXNTYPE_ID,AUTHTXN_CRDPLAN_ID,
                    AUTHTXN_REQUEST_DATE,sum(AUTHTXN_REQUEST_AMT)as total from CZ_AUTHTXN
                    where AUTHTXN_TXNTYPE_ID  = '$type'
                    and AUTHTXN_REQUEST_DATE between $start and $end
                    group by AUTHTXN_REQUEST_DATE,AUTHTXN_CRDACCT_NO, AUTHTXN_MERCHANT_NAME,AUTHTXN_REQUEST_AMT)tran_count 
                    where total.AUTHTXN_CUST_ID = tran_count.AUTHTXN_CUST_ID)fin
                    where fin.Total_Amt  > $reqamt1
                    group by fin.AUTHTXN_REQUEST_AMT,fin.AUTHTXN_REQUEST_DATE,fin.AUTHTXN_CRDACCT_NO
                    order by NO");
        return $GreaterThan;
    }
    public static function LessThan(Request $req)
    {
        $validation = $req->validate([
            "trans" => "required",
            "start" => "required",
            "end" => "required",
            "reqamt1" => "required"
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
        $sign = $req->sign;
        DB::connection('mysql2')->statement(DB::raw('set @row:=0'));
        $LessThan = DB::connection('mysql2')->select("select DISTINCT  @row:=@row + 1 AS NO,fin.AUTHTXN_CUST_ID,fin.AUTHTXN_CARDHOLDER_NAME,fin.AUTHTXN_CRDACCT_NO,
                    fin.AUTHTXN_REQUEST_AMT,fin.Tran_Count, (fin.Tran_count*fin.AUTHTXN_REQUEST_AMT)as Total,
                    fin.AUTHTXN_MERCHANT_NAME,fin.AUTHTXN_TXNTYPE_ID,fin.AUTHTXN_CRDPLAN_ID,fin.AUTHTXN_REQUEST_DATE
                    from
                    (SELECT total.Total_Amt, tran_count.AUTHTXN_CUST_ID,tran_count.AUTHTXN_CARDHOLDER_NAME,tran_count.AUTHTXN_CRDACCT_NO,
                    tran_count.AUTHTXN_REQUEST_AMT,tran_count.Tran_count, (tran_count.Tran_count*tran_count.AUTHTXN_REQUEST_AMT)as Total,
                    tran_count.AUTHTXN_MERCHANT_NAME,tran_count.AUTHTXN_TXNTYPE_ID,tran_count.AUTHTXN_CRDPLAN_ID,tran_count.AUTHTXN_REQUEST_DATE
                    FROM
                    (select B.* from
                    (select A.Tran_count,A.AUTHTXN_CUST_ID ,A.AUTHTXN_CARDHOLDER_NAME,A.AUTHTXN_REQUEST_AMT, sum(total)as Total_Amt 
                    from(select *,count(AUTHTXN_REQUEST_AMT)as Tran_count,sum(AUTHTXN_REQUEST_AMT)as total from CZ_AUTHTXN
                    where AUTHTXN_TXNTYPE_ID = '$type'
                    and AUTHTXN_REQUEST_DATE between $start and $end
                    group by AUTHTXN_REQUEST_DATE,AUTHTXN_CRDACCT_NO, AUTHTXN_MERCHANT_NAME,AUTHTXN_REQUEST_AMT)A
                    group by AUTHTXN_REQUEST_DATE,AUTHTXN_CRDACCT_NO, AUTHTXN_MERCHANT_NAME)B)total,
                    (select AUTHTXN_CUST_ID, AUTHTXN_CARDHOLDER_NAME, AUTHTXN_CRDACCT_NO, AUTHTXN_REQUEST_AMT,
                    count(AUTHTXN_REQUEST_AMT)as Tran_count,AUTHTXN_MERCHANT_NAME,AUTHTXN_TXNTYPE_ID,AUTHTXN_CRDPLAN_ID,
                    AUTHTXN_REQUEST_DATE,sum(AUTHTXN_REQUEST_AMT)as total from CZ_AUTHTXN
                    where AUTHTXN_TXNTYPE_ID  = '$type'
                    and AUTHTXN_REQUEST_DATE between $start and $end
                    group by AUTHTXN_REQUEST_DATE,AUTHTXN_CRDACCT_NO, AUTHTXN_MERCHANT_NAME,AUTHTXN_REQUEST_AMT)tran_count 
                    where total.AUTHTXN_CUST_ID = tran_count.AUTHTXN_CUST_ID)fin
                    where fin.Total_Amt  < $reqamt1
                    group by fin.AUTHTXN_REQUEST_AMT,fin.AUTHTXN_REQUEST_DATE,fin.AUTHTXN_CRDACCT_NO
                    order by NO");
        return $LessThan;
    }
    public static function ge(Request $req)
    {
        $validation = $req->validate([
            "trans" => "required",
            "start" => "required",
            "end" => "required",
            "reqamt1" => "required"
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
        $sign = $req->sign;
        DB::connection('mysql2')->statement(DB::raw('set @row:=0'));
        $ge = DB::connection('mysql2')->select("select DISTINCT  @row:=@row + 1 AS NO,fin.AUTHTXN_CUST_ID,fin.AUTHTXN_CARDHOLDER_NAME,fin.AUTHTXN_CRDACCT_NO,
                    fin.AUTHTXN_REQUEST_AMT,fin.Tran_Count, (fin.Tran_count*fin.AUTHTXN_REQUEST_AMT)as Total,
                    fin.AUTHTXN_MERCHANT_NAME,fin.AUTHTXN_TXNTYPE_ID,fin.AUTHTXN_CRDPLAN_ID,fin.AUTHTXN_REQUEST_DATE
                    from
                    (SELECT total.Total_Amt, tran_count.AUTHTXN_CUST_ID,tran_count.AUTHTXN_CARDHOLDER_NAME,tran_count.AUTHTXN_CRDACCT_NO,
                    tran_count.AUTHTXN_REQUEST_AMT,tran_count.Tran_count, (tran_count.Tran_count*tran_count.AUTHTXN_REQUEST_AMT)as Total,
                    tran_count.AUTHTXN_MERCHANT_NAME,tran_count.AUTHTXN_TXNTYPE_ID,tran_count.AUTHTXN_CRDPLAN_ID,tran_count.AUTHTXN_REQUEST_DATE
                    FROM
                    (select B.* from
                    (select A.Tran_count,A.AUTHTXN_CUST_ID ,A.AUTHTXN_CARDHOLDER_NAME,A.AUTHTXN_REQUEST_AMT, sum(total)as Total_Amt 
                    from(select *,count(AUTHTXN_REQUEST_AMT)as Tran_count,sum(AUTHTXN_REQUEST_AMT)as total from CZ_AUTHTXN
                    where AUTHTXN_TXNTYPE_ID = '$type'
                    and AUTHTXN_REQUEST_DATE between $start and $end
                    group by AUTHTXN_REQUEST_DATE,AUTHTXN_CRDACCT_NO, AUTHTXN_MERCHANT_NAME,AUTHTXN_REQUEST_AMT)A
                    group by AUTHTXN_REQUEST_DATE,AUTHTXN_CRDACCT_NO, AUTHTXN_MERCHANT_NAME)B)total,
                    (select AUTHTXN_CUST_ID, AUTHTXN_CARDHOLDER_NAME, AUTHTXN_CRDACCT_NO, AUTHTXN_REQUEST_AMT,
                    count(AUTHTXN_REQUEST_AMT)as Tran_count,AUTHTXN_MERCHANT_NAME,AUTHTXN_TXNTYPE_ID,AUTHTXN_CRDPLAN_ID,
                    AUTHTXN_REQUEST_DATE,sum(AUTHTXN_REQUEST_AMT)as total from CZ_AUTHTXN
                    where AUTHTXN_TXNTYPE_ID  = '$type'
                    and AUTHTXN_REQUEST_DATE between $start and $end
                    group by AUTHTXN_REQUEST_DATE,AUTHTXN_CRDACCT_NO, AUTHTXN_MERCHANT_NAME,AUTHTXN_REQUEST_AMT)tran_count 
                    where total.AUTHTXN_CUST_ID = tran_count.AUTHTXN_CUST_ID)fin
                    where fin.Total_Amt >= $reqamt1
                    group by fin.AUTHTXN_REQUEST_AMT,fin.AUTHTXN_REQUEST_DATE,fin.AUTHTXN_CRDACCT_NO
                    order by NO");
        return $ge;
    }
    public static function le(Request $req)
    {
        $validation = $req->validate([
            "trans" => "required",
            "start" => "required",
            "end" => "required",
            "reqamt1" => "required"
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
        $sign = $req->sign;
        DB::connection('mysql2')->statement(DB::raw('set @row:=0'));
        $le = DB::connection('mysql2')->select("select DISTINCT  @row:=@row + 1 AS NO,fin.AUTHTXN_CUST_ID,fin.AUTHTXN_CARDHOLDER_NAME,fin.AUTHTXN_CRDACCT_NO,
                    fin.AUTHTXN_REQUEST_AMT,fin.Tran_Count, (fin.Tran_count*fin.AUTHTXN_REQUEST_AMT)as Total,
                    fin.AUTHTXN_MERCHANT_NAME,fin.AUTHTXN_TXNTYPE_ID,fin.AUTHTXN_CRDPLAN_ID,fin.AUTHTXN_REQUEST_DATE
                    from
                    (SELECT total.Total_Amt, tran_count.AUTHTXN_CUST_ID,tran_count.AUTHTXN_CARDHOLDER_NAME,tran_count.AUTHTXN_CRDACCT_NO,
                    tran_count.AUTHTXN_REQUEST_AMT,tran_count.Tran_count, (tran_count.Tran_count*tran_count.AUTHTXN_REQUEST_AMT)as Total,
                    tran_count.AUTHTXN_MERCHANT_NAME,tran_count.AUTHTXN_TXNTYPE_ID,tran_count.AUTHTXN_CRDPLAN_ID,tran_count.AUTHTXN_REQUEST_DATE
                    FROM
                    (select B.* from
                    (select A.Tran_count,A.AUTHTXN_CUST_ID ,A.AUTHTXN_CARDHOLDER_NAME,A.AUTHTXN_REQUEST_AMT, sum(total)as Total_Amt 
                    from(select *,count(AUTHTXN_REQUEST_AMT)as Tran_count,sum(AUTHTXN_REQUEST_AMT)as total from CZ_AUTHTXN
                    where AUTHTXN_TXNTYPE_ID = '$type'
                    and AUTHTXN_REQUEST_DATE between $start and $end
                    group by AUTHTXN_REQUEST_DATE,AUTHTXN_CRDACCT_NO, AUTHTXN_MERCHANT_NAME,AUTHTXN_REQUEST_AMT)A
                    group by AUTHTXN_REQUEST_DATE,AUTHTXN_CRDACCT_NO, AUTHTXN_MERCHANT_NAME)B)total,
                    (select AUTHTXN_CUST_ID, AUTHTXN_CARDHOLDER_NAME, AUTHTXN_CRDACCT_NO, AUTHTXN_REQUEST_AMT,
                    count(AUTHTXN_REQUEST_AMT)as Tran_count,AUTHTXN_MERCHANT_NAME,AUTHTXN_TXNTYPE_ID,AUTHTXN_CRDPLAN_ID,
                    AUTHTXN_REQUEST_DATE,sum(AUTHTXN_REQUEST_AMT)as total from CZ_AUTHTXN
                    where AUTHTXN_TXNTYPE_ID  = '$type'
                    and AUTHTXN_REQUEST_DATE between $start and $end
                    group by AUTHTXN_REQUEST_DATE,AUTHTXN_CRDACCT_NO, AUTHTXN_MERCHANT_NAME,AUTHTXN_REQUEST_AMT)tran_count 
                    where total.AUTHTXN_CUST_ID = tran_count.AUTHTXN_CUST_ID)fin
                    where fin.Total_Amt <= $reqamt1
                    group by fin.AUTHTXN_REQUEST_AMT,fin.AUTHTXN_REQUEST_DATE,fin.AUTHTXN_CRDACCT_NO
                    order by NO");
        return $le;
    }
    public static function between(Request $req)
    {
        $validation = $req->validate([
            "trans" => "required",
            "start" => "required",
            "end" => "required",
            "reqamt1" => "required",
            "reqamt2" => "required"
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
        DB::connection('mysql2')->statement(DB::raw('set @row:=0'));
        $between = DB::connection('mysql2')->select("select DISTINCT  @row:=@row + 1 AS NO,fin.AUTHTXN_CUST_ID,fin.AUTHTXN_CARDHOLDER_NAME,fin.AUTHTXN_CRDACCT_NO,
                    fin.AUTHTXN_REQUEST_AMT,fin.Tran_Count, (fin.Tran_count*fin.AUTHTXN_REQUEST_AMT)as Total,
                    fin.AUTHTXN_MERCHANT_NAME,fin.AUTHTXN_TXNTYPE_ID,fin.AUTHTXN_CRDPLAN_ID,fin.AUTHTXN_REQUEST_DATE
                    from
                    (SELECT total.Total_Amt, tran_count.AUTHTXN_CUST_ID,tran_count.AUTHTXN_CARDHOLDER_NAME,tran_count.AUTHTXN_CRDACCT_NO,
                    tran_count.AUTHTXN_REQUEST_AMT,tran_count.Tran_count, (tran_count.Tran_count*tran_count.AUTHTXN_REQUEST_AMT)as Total,
                    tran_count.AUTHTXN_MERCHANT_NAME,tran_count.AUTHTXN_TXNTYPE_ID,tran_count.AUTHTXN_CRDPLAN_ID,tran_count.AUTHTXN_REQUEST_DATE
                    FROM
                    (select B.* from
                    (select A.Tran_count,A.AUTHTXN_CUST_ID ,A.AUTHTXN_CARDHOLDER_NAME,A.AUTHTXN_REQUEST_AMT, sum(total)as Total_Amt 
                    from(select *,count(AUTHTXN_REQUEST_AMT)as Tran_count,sum(AUTHTXN_REQUEST_AMT)as total from CZ_AUTHTXN
                    where AUTHTXN_TXNTYPE_ID = '$type'
                    and AUTHTXN_REQUEST_DATE between $start and $end
                    group by AUTHTXN_REQUEST_DATE,AUTHTXN_CRDACCT_NO, AUTHTXN_MERCHANT_NAME,AUTHTXN_REQUEST_AMT)A
                    group by AUTHTXN_REQUEST_DATE,AUTHTXN_CRDACCT_NO, AUTHTXN_MERCHANT_NAME)B)total,
                    (select AUTHTXN_CUST_ID, AUTHTXN_CARDHOLDER_NAME, AUTHTXN_CRDACCT_NO, AUTHTXN_REQUEST_AMT,
                    count(AUTHTXN_REQUEST_AMT)as Tran_count,AUTHTXN_MERCHANT_NAME,AUTHTXN_TXNTYPE_ID,AUTHTXN_CRDPLAN_ID,
                    AUTHTXN_REQUEST_DATE,sum(AUTHTXN_REQUEST_AMT)as total from CZ_AUTHTXN
                    where AUTHTXN_TXNTYPE_ID  = '$type'
                    and AUTHTXN_REQUEST_DATE between $start and $end
                    group by AUTHTXN_REQUEST_DATE,AUTHTXN_CRDACCT_NO, AUTHTXN_MERCHANT_NAME,AUTHTXN_REQUEST_AMT)tran_count 
                    where total.AUTHTXN_CUST_ID = tran_count.AUTHTXN_CUST_ID)fin
                    where fin.Total_Amt between $reqamt1 and $reqamt2
                    group by fin.AUTHTXN_REQUEST_AMT,fin.AUTHTXN_REQUEST_DATE,fin.AUTHTXN_CRDACCT_NO
                    order by NO");
        return $between;
    }
}
