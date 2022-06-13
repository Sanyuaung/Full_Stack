<?php

namespace App\Exports;

use App\Models\CCAnnualFee;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class CCAnnualFeeExport implements  FromCollection,WithHeadings,WithMapping,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function columnFormats(): array
    // {
    //     return [
    //         'A' => NumberFormat::FORMAT_TEXT, // CUST_ID
    //         'E' => NumberFormat::FORMAT_TEXT, // CONTACT_MOBILE
    //         'J' => NumberFormat::FORMAT_TEXT, // STMT_MONTH
    //         'K' => NumberFormat::FORMAT_TEXT, // CURRENCY
    //         'L' => NumberFormat::FORMAT_TEXT, // OPEN_BALANCE
    //         'M' => NumberFormat::FORMAT_TEXT, // ACCGRPLMT_CREDIT_LMT
    //         'N' => NumberFormat::FORMAT_TEXT, // CLOSE_BALANCE
    //     ];
    // }
    
    protected $month1, $date2 , $date1;
    function __construct($month1, $date2 , $date1)
    {
        $this->month1=$month1;
        $this->date2=$date2;
        $this->date1=$date1;
    }
    
    public function map($annual): array
    {
        return [

            $annual->CARD_CUST_ID,
            $annual->CARD_EMBOSSED_NAME,
            $annual->CARD_TYPE,
            "'".$annual->CARD_CRDACCT_NO,
            $annual->CARD_BS_IND,
            $annual->CARD_PLASTIC_CODE,
            $annual->CRDACCT_STATUS_ID,
            $annual->CRDACCT_AGE_CODE,
            $annual->CARD_PLASTIC_DATE,
            $annual->CARD_APP_DATE,
            $annual->CARD_EXPIRY_CCYYMM,
        ];
    }
    
    public function collection()
    {
        return collect(DB::connection('mysql2')->select("select CARD_CUST_ID, CARD_EMBOSSED_NAME, CARD_TYPE, CARD_CRDACCT_NO, 
        CARD_BS_IND, CARD_PLASTIC_CODE, B.CRDACCT_STATUS_ID, B.CRDACCT_AGE_CODE, CARD_PLASTIC_DATE,CARD_APP_DATE,
        CARD_EXPIRY_CCYYMM from CZ_CARD A, CZ_CRDACCT B, CZ_AUTHTXN C
        where A.CARD_CRDACCT_NO = B.CRDACCT_NO
        and A.CARD_NO = C.AUTHTXN_CARD_NO
        and A.CARD_TYPE like 'C'
        and substring(CARD_APP_DATE,5,2) like '$this->month1'
        and A.CARD_PLASTIC_CODE like 'A'
        and B.CRDACCT_STATUS_ID like 'A'
        group by CARD_CUST_ID, CARD_EMBOSSED_NAME, CARD_TYPE, CARD_CRDACCT_NO,
        CARD_BS_IND, CARD_PLASTIC_CODE, B.CRDACCT_STATUS_ID, B.CRDACCT_AGE_CODE, CARD_PLASTIC_DATE,CARD_APP_DATE,
        CARD_EXPIRY_CCYYMM, C.AUTHTXN_CARD_NO having max(C.AUTHTXN_REQUEST_DATE) < $this->date2"));
    }

    public function headings():array
    {
        return [
            "CARD_CUST_ID",
            "CARD_EMBOSSED_NAME",
            "CARD_TYPE",
            "CARD_CRDACCT_NO",
            "CARD_BS_IND",
            "CARD_PLASTIC_CODE",
            "CRDACCT_STATUS_ID",
            "CRDACCT_AGE_CODE",
            "CARD_PLASTIC_DATE",
            "CARD_APP_DATE",
            "CARD_EXPIRY_CCYYMM"];
    }
}