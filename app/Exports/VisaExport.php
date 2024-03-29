<?php

namespace App\Exports;

use App\Models\syavisatran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class VisaExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $startdate, $enddate;
    function __construct($startdate, $enddate)
    {
        $this->startdate = $startdate;
        $this->enddate = $enddate;
    }

    public function map($visa): array
    {
        return [
            $visa->settleDate,
            $visa->noTrans,
            $visa->usdAmt,
            $visa->mmkAmt,
            $visa->exRate,
            $visa->netAmt,
            $visa->settAmt_Nostro_USD,
            $visa->fundingDate,
            $visa->commAmt,
            $visa->typeOfTrans,
            $visa->cardType,
            $visa->currency,
            $visa->country
        ];
    }

    public function collection()
    {
        return collect(DB::connection('mysql2')
            ->select("select * from syavisatrans where settleDate between $this->startdate and $this->enddate"));
    }

    public function headings(): array
    {
        return [
            "SETTLEMENT DATE",
            "NUMBER OF TRANSACTIONS",
            "USD AMOUNT",
            "MMK AMOUNT",
            "EXCHANGE RATE",
            "NET SETTLEMENT AMOUNT",
            "SETTLEMENT AMOUNT (USD) AT NOSTRO",
            "FUNDING DATE",
            "COMMISSIONS AMOUNT",
            "TYPE OF TRANSACTION",
            "CARD TYPE",
            "AUTHORIZATION CURRENCY",
            "ISSUER COUNTRY"
        ];
    }
}
