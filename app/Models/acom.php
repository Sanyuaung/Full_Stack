<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class acom extends Model
{
    protected $guarded  =[];
    use HasFactory;
    public static function ACOM()
    {
        DB::statement(DB::raw('set @row:=0'));
        $ACOM=DB::select('select distinct substring(Field1,1,3) as recordtype,trim(substring(Field1,4,19)) as CardNo,substring(Field1,23,6) as process_code,
        format(concat(substring(Field1,29,10),".",substring(Field1,39,2)),2) as txn_amt,format(concat(substring(Field1,41,10),".",substring(Field1,51,2)),2) as settle_amt,substring(Field1,53,8) as sett_rate,substring(Field1,62,6) as system_trace,
        substring(Field1,69,6) as txn_time,substring(Field1,75,4) as txn_date,substring(Field1,79,4) as settle_date,substring(Field1,83,4) as MCC,
        substring(Field1,87,11) as Acq_institution_code,substring(Field1,98,11) as Issuer_bank_code,substring(Field1,109,11) as beneficiary_bank_code,
        substring(Field1,120,11) as Forward_institution_code,substring(Field1,131,6) as auth_no,substring(Field1,138,12) as RRN,substring(Field1,151,8) as Card_Acceptor_Terminal,
        substring(Field1,159,3) as txn_curr_code,substring(Field1,162,3) as settle_curr_code,substring(Field1,165,28) as from_acc,
        substring(Field1,193,28) as to_acc, substring(Field1,221,4) as msg_type_identifier,substring(Field1,225,4) as res_code,
        format(concat(substring(Field1,229,10),".",substring(Field1,239,2)),2) as receivable_fee,
        format(concat(substring(Field1,241,10),".",substring(Field1,251,2)),2) as payable_fee,
        format(concat(substring(Field1,253,10),".",substring(Field1,263,2)),2) as interchange_fee,substring(Field1,265,3) as POS_mode,
        substring(Field1,268,6) as system_traceno,substring(Field1,274,2) as POS_condition,substring(Field1,276,15) as card_acceptor_code,
        format(concat(substring(Field1,291,10),".",substring(Field1,301,2)),2) as accept_amt,
        format(concat(substring(Field1,303,10),".",substring(Field1,313,2)),2) as cardholder_fee,substring(Field1,315,10) as txn_tramsmission,(@row:=@row + 1) AS NO,filename
        from acoms');
        return $ACOM;
    }
}