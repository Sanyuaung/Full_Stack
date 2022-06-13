<?php

namespace App\Exports;

use App\Models\aerr;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AerrExport implements FromCollection,WithHeadings,WithMapping,ShouldAutoSize
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

    public function map($aerr): array
    {
        return [

            $aerr->recordtype,
            "'".$aerr->CardNo,
            $aerr->process_code,
            $aerr->txn_amt,
            $aerr->settle_amt,
            $aerr->sett_rate,
            $aerr->system_trace,
            $aerr->txn_time,
            $aerr->txn_date,
            $aerr->settle_date,
            $aerr->MCC,
            $aerr->Acq_institution_code,
            $aerr->Issuer_bank_code,
            $aerr->beneficiary_bank_code,
            $aerr->Forward_institution_code,
            $aerr->auth_no,
            "'".$aerr->RRN,
            $aerr->Card_Acceptor_Terminal,
            $aerr->txn_curr_code,
            $aerr->settle_curr_code,
            $aerr->from_acc,
            $aerr->to_acc,
            $aerr->msg_type_identifier,
            $aerr->reason_code,
            $aerr->receivable_fee,
            $aerr->payable_fee,
            $aerr->interchange_fee,
            $aerr->POS_mode,
            $aerr->system_traceno,
            $aerr->POS_condition,
            $aerr->card_acceptor_code,
            $aerr->accept_amt,
            $aerr->cardholder_fee,
            $aerr->txn_tramsmission,
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(aerr::aerr());
    }
}