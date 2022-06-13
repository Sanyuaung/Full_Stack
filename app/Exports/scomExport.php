<?php

namespace App\Exports;

use App\Models\scom;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class scomExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
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

    public function map($scom): array
    {
        return [

            $scom->recordtype,
            $scom->member_institution,
            $scom->Outgoing_amt_sign,
            $scom->Outgoing_amt,
            $scom->Outgoing_fee_sign,
            $scom->outgoing_fee,
            $scom->incoming_amt_sign,
            $scom->incoming_amt,
            $scom->incoming_fee_sign,
            $scom->incoming_fee,
            $scom->STF_amt_sign,
            $scom->STF_amt,
            $scom->STF_Fee_sign,
            $scom->STF_fee,
            $scom->outgoing_summary,
            $scom->incoming_summary,
            $scom->settlement_curr,
            $scom->reserved,
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(scom::scom());
    }
}