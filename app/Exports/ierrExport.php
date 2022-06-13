<?php

namespace App\Exports;

use App\Models\ierr;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ierrExport implements  FromCollection,WithHeadings,WithMapping,ShouldAutoSize
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

    public function map($ierr): array
    {
        return [

            $ierr->recordtype,
            "'".$ierr->CardNo,
            $ierr->process_code,
            $ierr->txn_amt,
            $ierr->settle_amt,
            $ierr->sett_rate,
            $ierr->system_trace,
            $ierr->txn_time,
            $ierr->txn_date,
            $ierr->settle_date,
            $ierr->MCC,
            $ierr->Acq_institution_code,
            $ierr->Issuer_bank_code,
            $ierr->beneficiary_bank_code,
            $ierr->Forward_institution_code,
            $ierr->auth_no,
            "'".$ierr->RRN,
            $ierr->Card_Acceptor_Terminal,
            $ierr->txn_curr_code,
            $ierr->settle_curr_code,
            $ierr->from_acc,
            $ierr->to_acc,
            $ierr->msg_type_identifier,
            $ierr->reason_code,
            $ierr->receivable_fee,
            $ierr->payable_fee,
            $ierr->interchange_fee,
            $ierr->POS_mode,
            $ierr->system_traceno,
            $ierr->POS_condition,
            $ierr->card_acceptor_code,
            $ierr->accept_amt,
            $ierr->cardholder_fee,
            $ierr->txn_tramsmission,
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(ierr::ierr());;
    }
}