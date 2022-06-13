<?php

namespace App\Exports;

use App\Models\acom;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class acomExport implements FromCollection, WithHeadings, WithMapping,ShouldAutoSize
{
    public function headings(): array
    {
        return[
            'Record_Type',
            'CardNo',
            'Processing_Code',
            'txn_amt',
            'settle_amt',
            'sett_rate',
            'system_trace',
            'txn_time',
            'txn_date',
            'settle_date',
            'MCC',
            'Acq_institution_code',
            'Issuer_bank_code',
            'beneficiary_bank_code',
            'Forward_institution_code',
            'auth_no',
            'RRN',
            'Card_Acceptor_Terminal',
            'txn_curr_code',
            'settle_curr_code',
            'from_acc',
            'to_acc',
            'msg_type_identifier',
            'res_code',
            'receivable_fee',
            'payable_fee',
            'interchange_fee',
            'POS_mode',
            'system_traceno',
            'POS_condition',
            'card_acceptor_code',
            'accept_amt',
            'cardholder_fee',
            'txn_tramsmission',
        ];
    }

    public function map($acom): array
    {
        return [

            $acom->recordtype,
            "'".$acom->CardNo,
            $acom->process_code,
            $acom->txn_amt,
            $acom->settle_amt,
            $acom->sett_rate,
            $acom->system_trace,
            $acom->txn_time,
            $acom->txn_date,
            $acom->settle_date,
            $acom->MCC,
            $acom->Acq_institution_code,
            $acom->Issuer_bank_code,
            $acom->beneficiary_bank_code,
            $acom->Forward_institution_code,
            $acom->auth_no,
            "'".$acom->RRN,
            $acom->Card_Acceptor_Terminal,
            $acom->txn_curr_code,
            $acom->settle_curr_code,
            $acom->from_acc,
            $acom->to_acc,
            $acom->msg_type_identifier,
            $acom->res_code,
            $acom->receivable_fee,
            $acom->payable_fee,
            $acom->interchange_fee,
            $acom->POS_mode,
            $acom->system_traceno,
            $acom->POS_condition,
            $acom->card_acceptor_code,
            $acom->accept_amt,
            $acom->cardholder_fee,
            $acom->txn_tramsmission,
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(acom::ACOM());
        ;
    }
}