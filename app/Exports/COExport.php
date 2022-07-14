<?php

namespace App\Exports;

use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class COExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithColumnFormatting

{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $date;
    function __construct($date,$branch)
    {
        $this->date = $date;
        $this->branch = $branch;
    }
    public function columnFormats(): array
    {
        return [
            'J' => NumberFormat::FORMAT_TEXT, 
        ];
    }
    public function map($co): array
    {
        return [

            $co->CUST_ID,
            $co->CUST_NAME,
            $co->CONTACT_NAME,
            $co->CONTACT_BIRTH_DATE,
            $co->CONTACT_IC,
            $co->CONTACT_MOBILE,
            $co->CARD_CARDPLAN_ID,
            $co->CONTACT_EMPLOYER_NAME,
            $co->CONTACT_STAFF,
            $co->CUST_BRANCH_ID,
            "'".$co->ACCOUNT_NO,
            $co->STMT_MONTH,
            $co->CURRENCY,
            $co->OPEN_BALANCE,
            $co->ACCGRPLMT_CREDIT_LMT,
            $co->CLOSE_BALANCE,
            $co->CURR_AGE_CODE,
            $co->STATUS,
        ];
    }

    public function collection()
    {
        return collect(DB::connection('mysql2')->select("select $this->date as date,@row:=@row + 1 AS NO, F.CUST_ID,F.CUST_NAME,C.CONTACT_NAME, 
        C.CONTACT_BIRTH_DATE, C.CONTACT_IC,C.CONTACT_MOBILE,A.CARD_CARDPLAN_ID,
        C.CONTACT_EMPLOYER_NAME, C.CONTACT_STAFF, A.CARD_BRANCH_ID AS CUST_BRANCH_ID,
        B.CSTMTACCT_ACCT_NO as ACCOUNT_NO,B.CSTMTACCT_YYYYMM AS STMT_MONTH, B.CSTMTACCT_CURRENCY AS CURRENCY,
        COALESCE(B.CSTMTACCT_ACCT_OPEN_BAL, 0) AS OPEN_BALANCE, E.ACCGRPLMT_CREDIT_LMT,
        COALESCE(B.CSTMTACCT_ACCT_BAL, 0) AS CLOSE_BALANCE,B.CSTMTACCT_CURR_AGE_CODE AS CURR_AGE_CODE, 
        CONCAT(CUST_STATUS_ID, '-', STS_NAME) AS STATUS
        FROM  CZ_CARD A
        INNER JOIN CZ_CUSTOMER F ON A.CARD_CUST_ID = F.CUST_ID AND 
        case when '$this->branch' like 'ALL' then CARD_BRANCH_ID like '%'
        else CARD_BRANCH_ID like '$this->branch' end
        INNER JOIN CZ_CSTMTACCT B ON B.CSTMTACCT_ACCT_NO =A.CARD_CRDACCT_NO 
        AND B.CSTMTACCT_CUST_ID=F.CUST_ID AND B.CSTMTACCT_CRDR_IND='C' AND B.CSTMTACCT_YYYYMM='$this->date'
        INNER JOIN CZ_ACCGRPLMT E ON E.ACCGRPLMT_CUST_ID=A.CARD_CUST_ID 
        LEFT JOIN CZ_CONTACT C ON C.CONTACT_ID=F.CUST_ID AND CONTACT_OF='CS' AND CONTACT_TYPE_ID='MAIN' 
        LEFT JOIN CZ_STATUS D ON STS_ID=CUST_STATUS_ID
        GROUP BY B.CSTMTACCT_ACCT_NO ORDER BY A.CARD_BRANCH_ID ASC"));
    }

    public function headings(): array
    {
        return [
            "CUST_ID", "CUST_NAME", "CONTACT_NAME", "CONTACT_BIRTH_DATE", "CONTACT_IC", "CONTACT_MOBILE","CARD_CARDPLAN_ID",
            "CONTACT_EMPLOYER_NAME", "CONTACT_STAFF", "CUST_BRANCH_ID", "ACCOUNT_NO",
            "STMT_MONTH", "CURRENCY", "OPEN_BALANCE", "ACCGRPLMT_CREDIT_LMT", "CLOSE_BALANCE", "CURR_AGE_CODE", "STATUS"
        ];
    }
}