<?php

namespace App\Exports;

use App\Models\creditstatus;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class creditstatusExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $date;
    function __construct($date)
    {
        $this->date = $date;
    }
    public function map($cr): array
    {
        return [
            $cr->CARD_CUST_ID,
            $cr->CARD_EMBOSSED_NAME,
            $cr->CARD_BS_IND,
            $cr->CRDLMT_CREDIT_LMT,
            $cr->CLOSE_BALANCE,
            $cr->CSTMTACCT_CURR_AGE_CODE,
            $cr->CARD_CARDPLAN_ID,
            $cr->CARD_PLASTIC_CODE,
            $cr->CSTMTACCT_YYYYMM,
        ];
    }

    public function collection()
    {
        return collect(DB::connection('mysql2')->select("select @row:=@row + 1 AS NO,A.CARD_CUST_ID,A.CARD_EMBOSSED_NAME,A.CARD_BS_IND,C.CRDLMT_CREDIT_LMT ,
        COALESCE(B.CSTMTACCT_ACCT_BAL, 0) AS CLOSE_BALANCE,B.CSTMTACCT_CURR_AGE_CODE,A.CARD_CARDPLAN_ID,
        A.CARD_PLASTIC_CODE,B.CSTMTACCT_YYYYMM
        FROM CZ_CARD A, CZ_CSTMTACCT B, CZ_CRDLMT C
        WHERE A.CARD_CRDACCT_NO = B.CSTMTACCT_ACCT_NO
        AND A.CARD_NO = C.CRDLMT_CARD_NO
        AND B.CSTMTACCT_YYYYMM=$this->date
        GROUP BY A.CARD_NO ORDER BY NO ASC"));
    }

    public function headings(): array
    {
        return [
            "CARD_CUST_ID",
            "CARD_EMBOSSED_NAME",
            "CARD_BS_IND",
            "CRDLMT_CREDIT_LMT",
            "CLOSE_BALANCE",
            "CSTMTACCT_CURR_AGE_CODE",
            "CARD_CARDPLAN_ID",
            "CARD_PLASTIC_CODE",
            "CSTMTACCT_YYYYMM",
        ];
    }
}