<?php

namespace App\Exports;

use App\Models\Trans;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\DB;

class SaleEcomBetweenExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{

    /**
     * @return \Illuminate\Support\Collection
     */
    protected $type, $start, $end, $reqamt1, $reqamt2, $sign;
    function __construct($type, $start, $end, $reqamt1, $reqamt2, $sign)
    {
        $this->start = $start;
        $this->end = $end;
        $this->type = $type;
        $this->sign = $sign;
        $this->reqamt1 = $reqamt1;
        $this->reqamt2 = $reqamt2;
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
            ->select("select DISTINCT  @row:=@row + 1 AS NO,fin.AUTHTXN_CUST_ID,fin.AUTHTXN_CARDHOLDER_NAME,fin.AUTHTXN_CRDACCT_NO,
            fin.AUTHTXN_REQUEST_AMT,fin.Tran_Count, (fin.Tran_count*fin.AUTHTXN_REQUEST_AMT)as Total,
            fin.AUTHTXN_MERCHANT_NAME,fin.AUTHTXN_TXNTYPE_ID,fin.AUTHTXN_CRDPLAN_ID,fin.AUTHTXN_REQUEST_DATE
            from
            (SELECT total.Total_Amt, tran_count.AUTHTXN_CUST_ID,tran_count.AUTHTXN_CARDHOLDER_NAME,tran_count.AUTHTXN_CRDACCT_NO,
            tran_count.AUTHTXN_REQUEST_AMT,tran_count.Tran_count, (tran_count.Tran_count*tran_count.AUTHTXN_REQUEST_AMT)as Total,
            tran_count.AUTHTXN_MERCHANT_NAME,tran_count.AUTHTXN_TXNTYPE_ID,tran_count.AUTHTXN_CRDPLAN_ID,tran_count.AUTHTXN_REQUEST_DATE
            FROM
            (select B.* from
            (select A.Tran_count,A.AUTHTXN_CUST_ID ,A.AUTHTXN_CARDHOLDER_NAME,A.AUTHTXN_REQUEST_AMT, sum(total)as Total_Amt 
            from(select *,count(AUTHTXN_REQUEST_AMT)as Tran_count,sum(AUTHTXN_REQUEST_AMT)as total from CZ_AUTHTXN
            where AUTHTXN_TXNTYPE_ID = '$this->type'
            and AUTHTXN_REQUEST_DATE between $this->start and $this->end
            group by AUTHTXN_REQUEST_DATE,AUTHTXN_CRDACCT_NO, AUTHTXN_MERCHANT_NAME,AUTHTXN_REQUEST_AMT)A
            group by AUTHTXN_REQUEST_DATE,AUTHTXN_CRDACCT_NO, AUTHTXN_MERCHANT_NAME)B)total,
            (select AUTHTXN_CUST_ID, AUTHTXN_CARDHOLDER_NAME, AUTHTXN_CRDACCT_NO, AUTHTXN_REQUEST_AMT,
            count(AUTHTXN_REQUEST_AMT)as Tran_count,AUTHTXN_MERCHANT_NAME,AUTHTXN_TXNTYPE_ID,AUTHTXN_CRDPLAN_ID,
            AUTHTXN_REQUEST_DATE,sum(AUTHTXN_REQUEST_AMT)as total from CZ_AUTHTXN
            where AUTHTXN_TXNTYPE_ID  = '$this->type'
            and AUTHTXN_REQUEST_DATE between $this->start and $this->end
            group by AUTHTXN_REQUEST_DATE,AUTHTXN_CRDACCT_NO, AUTHTXN_MERCHANT_NAME,AUTHTXN_REQUEST_AMT)tran_count 
            where total.AUTHTXN_CUST_ID = tran_count.AUTHTXN_CUST_ID)fin
            where fin.Total_Amt between $this->reqamt1 and $this->reqamt2
            group by fin.AUTHTXN_REQUEST_AMT,fin.AUTHTXN_REQUEST_DATE,fin.AUTHTXN_CRDACCT_NO
            order by NO"));
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
