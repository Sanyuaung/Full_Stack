<?php

namespace App\Exports;

use App\Models\ii_scom;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class scom901902Export implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    public function headings(): array
    {
        return[

              'recordtype',
              'member_institution',
              'curr_code',
              'statistics_txn_code',
              'no_txn_summary',
              'credit_amt',
              'debit_amt',
              'reserved',
        ];
    }

    public function map($scom_901902): array
    {
        return [


            $scom_901902->recordtype,
            $scom_901902->member_institution,
            $scom_901902->curr_code,
            $scom_901902->statistics_txn_code,
            $scom_901902->no_txn_summary,
            $scom_901902->credit_amt,
            $scom_901902->debit_amt,
            $scom_901902->reserved,
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(ii_scom::scom_901902());
    }
}