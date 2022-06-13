<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class jcb extends Model
{
    protected $guarded  =[];
    use HasFactory;
    public static function show()
    {
        DB::statement(DB::raw('set @row:=0'));
        $data=DB::select('select (@row:=@row + 1) AS NO,concat(substring(A.filename,12,2),".",substring(A.filename,10,2),".","20", substring(A.filename,8,2)) as date,substring(A.Field1,1,12) as Institution_Code,B.Short_Name,B.Account_Number,
         CASE
              WHEN substring(A.Field1,1,12) like "000%" THEN format(substring(A.Field1,162,28),2)
              ELSE "0.00"
              END AS MPU_Comm,
         CASE
             WHEN substring(A.Field1,1,12) like "000%" THEN "0.00"
             WHEN substring(A.Field1,139,2) like substring(A.Field1,160,2) THEN format(replace(substring(A.Field1,141,19),","," ") + replace(substring(A.Field1,162,28),","," "),2)
             ELSE format(replace(substring(A.Field1,141,19),","," ") - replace(substring(A.Field1,162,28),","," "),2)
             END AS Acq_Bank_Settle_Amt,
         CASE
             WHEN substring(A.Field1,1,12) like "000%" and 
             substring(A.Field1,139,2) like "0%" and substring(A.Field1,160,2) like "D%" THEN format(replace(substring(A.Field1,141,19),","," ") + replace(substring(A.Field1,162,28),","," "),2)
             WHEN substring(A.Field1,139,2) like "D%" and substring(A.Field1,160,2) like "C%" THEN format(replace(substring(A.Field1,141,19),","," ") + replace(substring(A.Field1,162,28),","," "),2)
             ELSE "0.00"
             END AS Debit,
         CASE
             WHEN substring(A.Field1,139,2) like "0%" and substring(A.Field1,160,2) like "C%" THEN format(substring(A.Field1,162,28),2)
             WHEN substring(A.Field1,139,2) like "D%" and substring(A.Field1,160,2) like "C%" THEN "0.00"
             WHEN substring(A.Field1,139,2) like "C%" and substring(A.Field1,160,2) like "C%" THEN format(replace(substring(A.Field1,141,19),","," ") + replace(substring(A.Field1,162,28),","," "),2)
             WHEN substring(A.Field1,139,2) like "C%" and substring(A.Field1,160,2) like "D%" THEN format(replace(substring(A.Field1,141,19),","," ") - replace(substring(A.Field1,162,28),","," "),2)
             ELSE "0.00"
             END AS Credit,
         substring(A.Field1,203,3) as Currency from jcbs A inner join institutiion_codes B
         on substring(A.Field1,1,12) = B.Institution_Code');
        return $data;
    }
    public static function total1()
    {
        $MPU_COMM=DB::select('select
            sum(CASE
            WHEN substring(A.Field1,1,12) like "000%" THEN substring(A.Field1,162,28)
            ELSE "0.00"
            END) AS one
            from jcbs A inner join institutiion_codes B
            on substring(A.Field1,1,12) = B.Institution_Code');
        return $MPU_COMM;
    }

    public static function total2()
    {
        $Acq_Bank_Settle_Amt=DB::select('select
            sum(CASE
            WHEN substring(A.Field1,1,12) like "000%" THEN "0.00"
            WHEN substring(A.Field1,139,2) like substring(A.Field1,160,2) THEN replace(substring(A.Field1,141,19),","," ") + replace(substring(A.Field1,162,28),","," ")
            ELSE replace(substring(A.Field1,141,19),","," ") - replace(substring(A.Field1,162,28),","," ")
            END) AS two
            from jcbs A inner join institutiion_codes B
            on substring(A.Field1,1,12) = B.Institution_Code');
        return $Acq_Bank_Settle_Amt;
    }

    public static function total3()
    {
        $Debit=DB::select('select
            sum(CASE
            WHEN substring(A.Field1,1,12) like "000%" and 
            substring(A.Field1,139,2) like "0%" and substring(A.Field1,160,2) like "D%" THEN replace(substring(A.Field1,141,19),","," ") + replace(substring(A.Field1,162,28),","," ")
            WHEN substring(A.Field1,139,2) like "D%" and substring(A.Field1,160,2) like "C%" THEN replace(substring(A.Field1,141,19),","," ") + replace(substring(A.Field1,162,28),","," ")
            ELSE "0.00"
            END) AS three
            from jcbs A inner join institutiion_codes B
            on substring(A.Field1,1,12) = B.Institution_Code');
        return $Debit;
    }

    public static function total4()
    {
        $Credit=DB::select('select
            sum(CASE
            WHEN substring(A.Field1,139,2) like "0%" and substring(A.Field1,160,2) like "C%" THEN replace(substring(A.Field1,141,19),","," ") + replace(substring(A.Field1,162,28),","," ")
            WHEN substring(A.Field1,139,2) like "C%" and substring(A.Field1,160,2) like "C%" THEN replace(substring(A.Field1,141,19),","," ") + replace(substring(A.Field1,162,28),","," ")
            WHEN substring(A.Field1,139,2) like "C%" and substring(A.Field1,160,2) like "D%" THEN replace(substring(A.Field1,141,19),","," ") - replace(substring(A.Field1,162,28),","," ")
            ELSE "0.00"
            END) AS four
            from jcbs A inner join institutiion_codes B
            on substring(A.Field1,1,12) = B.Institution_Code');
        return $Credit;
    }
}
