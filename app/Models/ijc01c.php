<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ijc01c extends Model
{
    protected $guarded  =[];
    use HasFactory;
    public static function ijc01c()
    {
        DB::statement(DB::raw('set @row:=0'));
        $ijc01c=DB::select('select (@row:=@row + 1) AS NO,filename,substring(Field1,1,3) as Record_Type,substring(Field1,4,19) as PAN,substring(Field1,23,6) as Processing_Code,
        format(concat(substring(Field1,29,10),".",substring(Field1,39,2)),2) as Amount_Transaction,
        format(concat(substring(Field1,41,10),".",substring(Field1,51,2)),2) as Amount_Settlement,substring(Field1,53,10) as Sett_Conversion_Rate,
        substring(Field1,63,3) as Currency_Code_Transaction,substring(Field1,66,3) as Settlement_Currency_Code,
        concat(substring(Field1,69,2),"/",substring(Field1,71,2)," ",substring(Field1,73,2),":",substring(Field1,75,2),":",substring(Field1,77,2)) as Transmission_Date_and_Time,
        substring(Field1,79,6) as System_Trace_Audit_Number,
        substring(Field1,85,6) as Authorization_Identification_Response,concat(substring(Field1,91,2),"/",substring(Field1,93,2))as Date_Authorization,
        substring(Field1,95,12) as RRN,substring(Field1,107,11) as Acquring_IIN,substring(Field1,118,11) as Forwarding_IIN,
        substring(Field1,129,4) as Merchant_Type,substring(133,8) as Card_Acceptor_Terminal_Identification,
        substring(Field1,141,15) as Card_Acceptor_Identification,substring(Field1,156,40) as Card_Acceptor_Name,
        substring(Field1,196,23) as Original_Transaction_Information,substring(Field1,219,4) as Message_Reason_Code,
        substring(Field1,223,11) as Receiving_IIN,substring(Field1,234,11) as Issuing_IIN,substring(Field1,245,1) as Identifer_of_Transaction_Feature,
        substring(Field1,246,2) as Point_of_Service_Condition_Code,substring(Field1,248,3) as Merchant_Country_Code,
        substring(Field1,251,3) as Authorization_Type,format(concat(substring(Field1,254,10),".",substring(Field1,264,2)),2) as Service_Fee_Receivable,
        format(concat(substring(Field1,266,10),".",substring(Field1,276,2)),2) as Service_Fee_Payable,substring(Field1,278,5) as Reserved from ijc01cs');
        return $ijc01c;
    }
}
