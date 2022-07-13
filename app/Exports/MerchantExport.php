<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MerchantExport implements FromCollection, WithMapping, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function map($merchant): array
    {
        return [
           $merchant->MERCHANT_ID,
           $merchant->MERCHANT_TRADE_NAME,
        ];
    }

    public function collection()
    {
        return collect(DB::connection('mysql2')->select("select MERCHANT_ID, MERCHANT_TRADE_NAME FROM CZ_MERCHANT"));
    }
}