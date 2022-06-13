<?php

namespace App\Exports;

use App\Models\ijc01_900;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ijc01_900sExport implements FromCollection,WithHeadings,WithMapping,ShouldAutoSize
{
    public function headings(): array
    {
        return[

            'recordtype',
            'member_institution',
            'Outgoing_amt_sign',
            'Outgoing_amt',
            'Outgoing_fee_sign',
            'outgoing_fee',
            'incoming_amt_sign',
            'incoming_amt',
            'incoming_fee_sign',
            'incoming_fee',
            'STF_amt_sign',
            'STF_amt',
            'STF_Fee_sign',
            'STF_fee',
            'outgoing_sum</th',
            'incoming_summary',
            'settlement_curr',
            'reserved',
        ];
    }

    public function map($ijc01_900s): array
    {
        return [

            $ijc01_900s->recordtype,
            $ijc01_900s->member_institution,
            $ijc01_900s->Outgoing_amt_sign,
            $ijc01_900s->Outgoing_amt,
            $ijc01_900s->Outgoing_fee_sign,
            $ijc01_900s->outgoing_fee,
            $ijc01_900s->incoming_amt_sign,
            $ijc01_900s->incoming_amt,
            $ijc01_900s->incoming_fee_sign,
            $ijc01_900s->incoming_fee,
            $ijc01_900s->STF_amt_sign,
            $ijc01_900s->STF_amt,
            $ijc01_900s->STF_Fee_sign,
            $ijc01_900s->STF_fee,
            $ijc01_900s->outgoing_summary,
            $ijc01_900s->incoming_summary,
            $ijc01_900s->settlement_curr,
            $ijc01_900s->reserved,
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(ijc01_900::ijc01_900s());
    }
}