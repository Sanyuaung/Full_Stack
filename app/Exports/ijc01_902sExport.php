<?php

namespace App\Exports;

use App\Models\ijc01_902;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ijc01_902sExport implements FromCollection,WithHeadings,WithMapping,ShouldAutoSize
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

    public function map($ijc01_902): array
    {
        return [


            $ijc01_902->recordtype,
            $ijc01_902->member_institution,
            $ijc01_902->curr_code,
            $ijc01_902->statistics_txn_code,
            $ijc01_902->no_txn_summary,
            $ijc01_902->credit_amt,
            $ijc01_902->debit_amt,
            $ijc01_902->reserved,
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(ijc01_902::ijc01_902());
    }
}