<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class inc01c extends Model
{
    protected $guarded  =[];
    use HasFactory;
    public static function inc01c()
    {
        DB::statement(DB::raw('set @row:=0'));
        $inc01c=DB::select('select (@row:=@row + 1) AS NO,filename,substring(Field1,1,3) as Record_Type,substring(Field1,4,19) as PAN,substring(Field1,23,6) as Processing_Code,
        format(concat(substring(Field1,29,10),".",substring(Field1,39,2)),2) as Amount_Transaction,
        format(concat(substring(Field1,41,10),".",substring(Field1,51,2)),2) as Amount_Settlement,substring(Field1,53,8) as Sett_Conversion_Rate,
        substring(Field1,61,3) as Currency_Code_Transaction,substring(Field1,64,3) as Settlement_Currency_Code,
        concat(substring(Field1,67,2),"/",substring(Field1,69,2)," ",substring(Field1,71,2),":",substring(Field1,73,2),":",substring(Field1,75,2)) as Transmission_Date_and_Time,
        substring(Field1,77,6) as System_Trace_Audit_Number,
        substring(Field1,83,6) as Authorization_Identification_Response,concat(substring(Field1,89,2),"/",substring(Field1,91,2)) as Date_Authorization,
        substring(Field1,93,12) as RRN,substring(Field1,105,11) as Acquring_IIN,substring(Field1,116,11) as Forwarding_IIN,
        substring(Field1,127,4) as Merchant_Type,substring(131,8) as Card_Acceptor_Terminal_Identification,
        substring(Field1,139,15) AS Card_Acceptor_Identification,B.MERCHANT_TRADE_NAME as Card_Acceptor_Name,
        substring(Field1,194,23) as Original_Transaction_Information,substring(Field1,217,4) as Message_Reason_Code,
        substring(Field1,221,11) as Receiving_IIN,substring(Field1,232,11) as Issuing_IIN,substring(Field1,243,1) as Identifer_of_Transaction_Feature,
        substring(Field1,244,2) as Point_of_Service_Condition_Code,substring(Field1,246,3) as Merchant_Country_Code,
        substring(Field1,249,3) as Authorization_Type,format(concat(substring(Field1,252,10),".",substring(Field1,262,2)),2) as Service_Fee_Receivable,
        format(concat(substring(Field1,264,10),".",substring(Field1,274,2)),2) as Service_Fee_Payable,
        substring(Field1,276,5) as Reserved from inc01cs A left join merchants B on substring(Field1,139,15) = B.MERCHANT_ID');
        return $inc01c;
    }
    public static function iuc01c()
    {
        DB::statement(DB::raw('set @row:=0'));
        $iuc01c=DB::select('select (@row:=@row + 1) AS NO,filename,substring(Field1,1,3) as Record_Type,substring(Field1,4,19) as PAN,substring(Field1,23,6) as Processing_Code,
        format(concat(substring(Field1,29,10),".",substring(Field1,39,2)),2) as Amount_Transaction,
        format(concat(substring(Field1,41,6),".",substring(Field1,47,6)),6) as Amount_Settlement,substring(Field1,53,8) as Sett_Conversion_Rate,
        substring(Field1,61,3) as Currency_Code_Transaction,substring(Field1,64,3) as Settlement_Currency_Code,
        concat(substring(Field1,67,2),"/",substring(Field1,69,2)," ",substring(Field1,71,2),":",substring(Field1,73,2),":",substring(Field1,75,2)) as Transmission_Date_and_Time,
        substring(Field1,77,6) as System_Trace_Audit_Number,
        substring(Field1,83,6) as Authorization_Identification_Response,concat(substring(Field1,89,2),"/",substring(Field1,91,2)) as Date_Authorization,
        substring(Field1,93,12) as RRN,substring(Field1,105,11) as Acquring_IIN,substring(Field1,116,11) as Forwarding_IIN,
        substring(Field1,127,4) as Merchant_Type,substring(131,8) as Card_Acceptor_Terminal_Identification,
        substring(Field1,139,15) AS Card_Acceptor_Identification,B.MERCHANT_TRADE_NAME as Card_Acceptor_Name,
        substring(Field1,194,23) as Original_Transaction_Information,substring(Field1,217,4) as Message_Reason_Code,
        substring(Field1,221,11) as Receiving_IIN,substring(Field1,232,11) as Issuing_IIN,substring(Field1,243,1) as Identifer_of_Transaction_Feature,
        substring(Field1,244,2) as Point_of_Service_Condition_Code,substring(Field1,246,3) as Merchant_Country_Code,
        substring(Field1,249,3) as Authorization_Type,format(concat(substring(Field1,252,6),".",substring(Field1,258,6)),6) as Service_Fee_Receivable,
        format(concat(substring(Field1,264,6),".",substring(Field1,270,6)),6) as Service_Fee_Payable,
        substring(Field1,276,5) as Reserved from inc01cs A left join merchants B on substring(Field1,139,15) = B.MERCHANT_ID');
        return $iuc01c;
    }
}