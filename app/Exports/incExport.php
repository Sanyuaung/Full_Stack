<?php

namespace App\Exports;

use App\Models\inc;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class incExport implements FromCollection, WithHeadings, WithMapping,ShouldAutoSize
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
            'outgoing_sum',
            'incoming_summary',
            'settlement_curr',
            'reserved',
        ];
    }

    public function map($inc11s): array
    {
        return [

            $inc11s->recordtype,
            $inc11s->member_institution,
            $inc11s->Outgoing_amt_sign,
            $inc11s->Outgoing_amt,
            $inc11s->Outgoing_fee_sign,
            $inc11s->outgoing_fee,
            $inc11s->incoming_amt_sign,
            $inc11s->incoming_amt,
            $inc11s->incoming_fee_sign,
            $inc11s->incoming_fee,
            $inc11s->STF_amt_sign,
            $inc11s->STF_amt,
            $inc11s->STF_Fee_sign,
            $inc11s->STF_fee,
            $inc11s->outgoing_summary,
            $inc11s->incoming_summary,
            $inc11s->settlement_curr,
            $inc11s->reserved,
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(inc::inc11s());
    }
}