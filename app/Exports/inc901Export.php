<?php

namespace App\Exports;

use App\Models\ii_inc;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class inc901Export implements FromCollection, WithHeadings, WithMapping,ShouldAutoSize
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

    public function map($inc11s_901): array
    {
        return [


            $inc11s_901->recordtype,
            $inc11s_901->member_institution,
            $inc11s_901->curr_code,
            $inc11s_901->statistics_txn_code,
            $inc11s_901->no_txn_summary,
            $inc11s_901->credit_amt,
            $inc11s_901->debit_amt,
            $inc11s_901->reserved,
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(ii_inc::inc11s_901());
    }
}