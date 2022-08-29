<?php

namespace App\Exports;

use App\Models\Trans;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\DB;

class SaleEcomAllExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{

    /**
     * @return \Illuminate\Support\Collection
     */
    protected $type, $start, $end;
    function __construct($type, $start, $end)
    {
        $this->start = $start;
        $this->end = $end;
        $this->type = $type;
    }
    public function map($SaleEcom): array
    {
        return [
            "'" . $SaleEcom->AUTHTXN_CUST_ID,
            $SaleEcom->AUTHTXN_CARDHOLDER_NAME,
            "'" . $SaleEcom->AUTHTXN_CRDACCT_NO,
            $SaleEcom->AUTHTXN_REQUEST_AMT,
            $SaleEcom->Tran_Count,
            $SaleEcom->Total,
            $SaleEcom->AUTHTXN_MERCHANT_NAME,
            $SaleEcom->AUTHTXN_TXNTYPE_ID,
            $SaleEcom->AUTHTXN_CRDPLAN_ID,
            $SaleEcom->AUTHTXN_REQUEST_DATE,
        ];
    }

    public function collection()
    {
        return collect(DB::connection('mysql2')
            ->select("select AUTHTXN_CUST_ID, AUTHTXN_CARDHOLDER_NAME, AUTHTXN_CRDACCT_NO, AUTHTXN_REQUEST_AMT, count(AUTHTXN_REQUEST_AMT) as Tran_Count,
            (AUTHTXN_REQUEST_AMT*(count(AUTHTXN_REQUEST_AMT))) as Total,AUTHTXN_MERCHANT_NAME,
            AUTHTXN_TXNTYPE_ID,AUTHTXN_CRDPLAN_ID,AUTHTXN_REQUEST_DATE from CZ_AUTHTXN 
            where AUTHTXN_TXNTYPE_ID = '$this->type'
            and AUTHTXN_REQUEST_DATE between $this->start and $this->end
            group by AUTHTXN_CRDACCT_NO, AUTHTXN_MERCHANT_NAME, AUTHTXN_REQUEST_DATE, AUTHTXN_REQUEST_AMT
            order by AUTHTXN_CRDACCT_NO"));
    }

    public function headings(): array
    {
        return [
            "AUTHTXN_CUST_ID",
            "AUTHTXN_CARDHOLDER_NAME",
            "AUTHTXN_CRDACCT_NO",
            "AUTHTXN_REQUEST_AMT",
            "Tran_Count",
            "Total",
            "AUTHTXN_MERCHANT_NAME",
            "AUTHTXN_TXNTYPE_ID",
            "AUTHTXN_CRDPLAN_ID",
            "AUTHTXN_REQUEST_DATE",
        ];
    }
}
