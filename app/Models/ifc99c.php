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
        format(concat(substring(Field1,27,10),".",substring(Field1,37,2)),2)as Txn_Amount,substring(Field1,39,3) as Curr,
        substring(Field1,42,10) as Txn_datetime, substring(Field1,52,6) as trace_no,substring(Field1,58,6) as Auth_ID_resp,
        substring(Field1,64,4) as Date_Auth,substring(Field1,68,12) as RRN,substring(Field1,80,11) as Acq_ID,
        substring(Field1,91,11) as Forward_ID,substring(Field1,102,4) as merchant_type,substring(Field1,106,8) as Card_acceptor_id,
        substring(Field1,114,15) as Card_acceptorid_code,substring(Field1,129,40) as Card_acceptor_name,
        substring(Field1,169,23) as Origin_txn,substring(Field1,192,4) as msg_reason,substring(Field1,196,1) as single_dual,
        substring(Field1,197,9) as GSCS_serial,substring(Field1,206,11) as Receiving_ID,substring(Field1,217,11) as Issuing_ID, 
        substring(Field1,228,1) as ID_GSCS,substring(Field1,229,2) as Txn_initial_channel, substring(Field1,231,1) as Txn_features,
        substring(Field1,232,3) as Txn_scenario,substring(Field1,235,5) as Reserved, substring(Field1,240,30) as other_info, 
        substring(Field1,270,3) as POS_entry_mode,substring(Field1,273,1) as Floor_limit,substring(Field1,274,2) as Type_PaymentService,
        format(concat(substring(Field1,276,10),".",substring(Field1,286,2)),2) as Settlement_Amt,
        substring(Field1,288,3) as settlement_curr,substring(Field1,291,8) as settlement_convert_rate,
        format(concat(substring(Field1,299,10),".",substring(Field1,309,2)),2) as Cardholder_billamt,
        substring(Field1,311,3) as Cardholder_bill_curr,substring(Field1,314,8) as Cardholder_billing_convert_rate,
        concat (substring(Field1,329,3),".",substring(Field1,332,2) ) as Net_Fee_Amt,substring(Field1,334,3) as IRF_Curr,
        substring(Field1,337,8) as Exrate_RF_bill_to_settlement_curr,substring(Field1,345,3) as Abbrev_Foreign_institute,
        substring(Field1,348,1) as mainland_china_txn_ind,format(concat(substring(Field1,349,10),".",substring(Field1,359,2)),2) as Txn_fee,
        substring(Field1,361,29) as QRC_voucher_no,substring(Field1,390,7) as Reserved1,substring(Field1,397,16) as Applied_cryptogram,
        substring(Field1,413,3) as POS_entry_mode1,substring(Field1,416,3) as Application_PAN_seq_num,substring(Field1,419,1) as Terminal_entry_capability,
        substring(Field1,420,1) as IC_card_condition_code,substring(Field1,421,6) as Terminal_capabilities,substring(Field1,427,10) as Terminal_verification_results,
        substring(Field1,437,8) as Unpredictable_number,substring(Field1,445,8) as Serial_number_of_interface_device,substring(Field1,453,64) as Issuing_bank_application_data,
        substring(Field1,517,4) as Application_transaction_counter,substring(Field1,521,4) as Application_alternation_characteristic,
        substring(Field1,525,6) as Transaction_date,substring(Field1,531,3) as Country_code_of_the_terminal,substring(Field1,534,42) as Script_result_of_the_card_Issuer,
        substring(Field1,576,2) as Authorization_response_code,substring(Field1,578,2) as Transaction_category,substring(Field1,580,12) as Authorized_amount,substring(Field1,592,3) as Currency_code_transaction,
        substring(Field1,595,2) as Cipher_text_information_data,substring(Field1,597,12) as Other_amount,substring(Field1,609,6) as Authentication_method_and_result_of_the_cardholder,substring(Field1,615,2) as Terminal_category,
        substring(Field1,617,32) as Dedicated_document_name,substring(Field1,649,4) as Application_version_number,substring(Field1,653,8) as Transaction_serial_counter,substring(Field1,661,30) as Reserved2,
        (@row:=@row + 1) AS NO,filename from ifc99cs
        order by substring(Field1,8,19)');
        return $ifc99c;
    }
}