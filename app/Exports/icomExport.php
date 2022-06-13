<?php

namespace App\Exports;

use App\Models\icom;
use App\Models\inc11s;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class icomExport implements FromCollection,WithHeadings,WithMapping,ShouldAutoSize
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

    public function map($icom): array
    {
        return [

            $icom->recordtype,
            "'".$icom->CardNo,
            $icom->process_code,
            $icom->txn_amt,
            $icom->settle_amt,
            $icom->sett_rate,
            $icom->system_trace,
            $icom->txn_time,
            $icom->txn_date,
            $icom->settle_date,
            $icom->MCC,
            $icom->Acq_institution_code,
            $icom->Issuer_bank_code,
            $icom->beneficiary_bank_code,
            $icom->Forward_institution_code,
            $icom->auth_no,
            "'".$icom->RRN,
            $icom->Card_Acceptor_Terminal,
            $icom->txn_curr_code,
            $icom->settle_curr_code,
            $icom->from_acc,
            $icom->to_acc,
            $icom->msg_type_identifier,
            $icom->res_code,
            $icom->receivable_fee,
            $icom->payable_fee,
            $icom->interchange_fee,
            $icom->POS_mode,
            $icom->system_traceno,
            $icom->POS_condition,
            $icom->card_acceptor_code,
            $icom->accept_amt,
            $icom->cardholder_fee,
            $icom->txn_tramsmission,
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(icom::ICOM());;
    }
}