<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class ifc99c extends Model
{
    protected $guarded  = [];
    use HasFactory;
    public static function ifc99c()
    {
        DB::statement(DB::raw('set @row:=0'));
        $ifc99c = DB::select('select substring(Field1,1,3) as Txn_code,substring(Field1,4,4) as bitmap,substring(Field1,8,19) as Cardno,
        format(concat(substring(Field1,27,10)," . ",substring(Field1,37,2)),2)as Txn_Amount,substring(Field1,39,3) as Curr,
        substring(Field1,42,10) as Txn_datetime, substring(Field1,52,6) as trace_no,substring(Field1,58,6) as Auth_ID_resp,
        substring(Field1,64,4) as Date_Auth,substring(Field1,68,12) as RRN,substring(Field1,80,11) as Acq_ID,
        substring(Field1,91,11) as Forward_ID,substring(Field1,102,4) as merchant_type,substring(Field1,106,8) as Card_acceptor_id,
        substring(Field1,114,15) as Card_acceptorid_code,substring(Field1,129,40) as Card_acceptor_name,
        substring(Field1,169,23) as Origin_txn,substring(Field1,192,4) as msg_reason,substring(Field1,196,1) as single_dual,
        substring(Field1,197,9) as GSCS_serial,substring(Field1,206,11) as Receiving_ID,substring(Field1,217,11) as Issuing_ID, 
        substring(Field1,228,1) as ID_GSCS,substring(Field1,229,2) as Txn_initial_channel, substring(Field1,231,1) as Txn_features,
        substring(Field1,232,3) as Txn_scenario,substring(Field1,235,5) as Reserved, substring(Field1,240,30) as other_info, 
        substring(Field1,270,3) as POS_entry_mode,substring(Field1,273,1) as Floor_limit,substring(Field1,274,2) as Type_PaymentService,
        format(concat(substring(Field1,276,10)," . ",substring(Field1,286,2)),2) as Settlement_Amt,
        substring(Field1,288,3) as settlement_curr,substring(Field1,291,8) as settlement_convert_rate,
        format(concat(substring(Field1,299,10)," . ",substring(Field1,309,2)),2) as Cardholder_billamt,
        substring(Field1,311,3) as Cardholder_bill_curr,substring(Field1,314,8) as Cardholder_billing_convert_rate,
        substring(Field1,322,12) as Net_Fee_Amt,substring(Field1,334,3) as IRF_Curr,
        substring(Field1,337,8) as Exrate_RF_bill_to_settlement_curr,substring(Field1,345,3) as Abbrev_Foreign_institute,
        substring(Field1,348,1) as mainland_china_txn_ind,format(concat(substring(Field1,349,10)," . ",
        substring(Field1,359,2)),2) as Txn_fee,substring(Field1,361,29) as QRC_voucher_no,
        (@row:=@row + 1) AS NO,filename from ifc99cs
        order by substring(Field1,8,19)');
        return $ifc99c;
    }
}
