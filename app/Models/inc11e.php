<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class inc11e extends Model
{
    protected $guarded  =[];
    use HasFactory;
    public static function inc11e()
    {
        DB::statement(DB::raw('set @row:=0'));
        $inc11e=DB::select('select substring(Field1,1,3) as recordtype,substring(Field1,4,19) as PAN,substring(Field1,23,6) as Processing_Code,
        concat(substring(Field1,29,10),".",substring(39,2)) as Amount_Transaction,concat(substring(Field1,41,10),".",substring(Field1,51,2)) as Amount_Settlement,
        substring(Field1,53,8) as Sett_Conversion_Rate,substring(Field1,61,3) as Currency_Code_Transaction,substring(Field1,64,3) as Settlement_Currency_Code,
        substring(Field1,67,10) as Transmission_Date_and_Time,substring(Field1,77,6) as System_Trace_Audit_Number,substring(Field1,83,6) as Authorization_Identification_Response,
        substring(Field1,89,4) as Date_of_Authorization,substring(Field1,93,12) as RRN,substring(Field1,105,11) as Acquiring_IIN,
        substring(Field1,116,11) as Forwarding_IIC,substring(Field1,127,4) as Merchant_Type,substring(Field1,131,8) as Card_Acceptor_Terminal_Identification,
        substring(Field1,139,15) as Card_Acceptor_Identification_Code,substring(Field1,154,40) as Card_Acceptor_Name,substring(Field1,194,23) as Original_Transaction_Information,
        substring(Field1,217,4) as Message_Reason_Code,substring(Field1,221,11) as Receivig_IIC,substring(Field1,232,11) as Issuing_IIC,substring(Field1,243,1) as Identifier_of_Transaction_Features,
        substring(Field1,244,2) as Point_of_Service_Condition_Code,substring(Field1,246,3) as Merchant_Currency,substring(Field1,249,3) as Authorization_Type,
        concat(substring(Field1,252,10),".",substring(Field1,262,2)) as Service_Fee_Receivable,concat(substring(Field1,264,10),".",substring(Field1,274,2)) as Service_Fee_Payable,substring(Field1,276,5) as Reserved,
        (@row:=@row + 1) AS NO,filename
        from inc11es');
        return $inc11e;
    }
}
