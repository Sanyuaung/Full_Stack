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

class AnnualFeeListingExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
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

    protected $month, $card;
    function __construct($month, $card)
    {
        $this->month = $month;
        $this->card = $card;
    }

    public function map($data): array
    {
        return [
            $data->CARD_CUST_ID,
            $data->CARD_EMBOSSED_NAME,
            "'" . $data->CARD_CRDACCT_NO,
            $data->CARD_CARDPLAN_ID,
            $data->CARD_PLAN,
            $data->CARD_BS_IND,
            $data->CARD_PLASTIC_CODE,
            $data->CUST_STATUS_ID,
            $data->CRDACCT_STATUS_ID,
            $data->CARD_APP_DATE,
            $data->Last_Annual,
            $data->CONTACT_STAFF,
        ];
    }

    public function collection()
    {
        if ($this->card === 'MPU_CLASSIC') {
            return collect(DB::connection('mysql2')
                ->select("select CARD_CUST_ID,CARD_NO, CARD_EMBOSSED_NAME, CARD_CRDACCT_NO, CARD_CARDPLAN_ID,
                CASE
                WHEN CARD_CARDPLAN_ID IN ('CRD_CLSC','IV_CRD_CLS') THEN 'MPU_CLASSIC'
                WHEN CARD_CARDPLAN_ID IN ('CRD_GOLD','IV_CRD_GLD','PA_CRD_GLD') THEN 'MPU_GOLD'
                WHEN CARD_CARDPLAN_ID IN ('MU_GOLD','MU_W1Y_GLD') THEN 'UPI_GOLD'
                WHEN CARD_CARDPLAN_ID IN ('MU_PLATN','MU_PLT_WHF') THEN 'UPI_PLTN'
                END AS CARD_PLAN,
                A.CARD_BS_IND, CARD_PLASTIC_CODE, B.CUST_STATUS_ID, C.CRDACCT_STATUS_ID, A.CARD_APP_DATE, max(CSTMTXN_YYYYMM) as Last_Annual, D.CONTACT_STAFF
                from CZ_CARD A, CZ_CUSTOMER B, CZ_CRDACCT C, CZ_CONTACT D, CZ_CSTMTXN E
                where A.CARD_CUST_ID = B.CUST_ID
                AND SUBSTRING(A.CARD_APP_DATE,5,2) LIKE '$this->month'
                and A.CARD_CUST_ID = C.CRDACCT_CUST_ID
                and B.CUST_ID = D.CONTACT_ID
                and C.CRDACCT_NO = E.CSTMTXN_ACCT_ID
                and CARD_TYPE like 'C'
                and CARD_CARDPLAN_ID like '%CRD_CLS%'
                and E.CSTMTXN_TYPE in ('CFESY0020','CDAMN00RF')
                and A.CARD_PLASTIC_CODE not in ('V','T','D','E','K')
                group by A.CARD_NO, A.CARD_BS_IND"));
        } elseif ($this->card === 'MPU_GOLD') {
            return collect(DB::connection('mysql2')
                ->select("select CARD_CUST_ID,CARD_NO, CARD_EMBOSSED_NAME, CARD_CRDACCT_NO, CARD_CARDPLAN_ID,
                CASE
                WHEN CARD_CARDPLAN_ID IN ('CRD_CLSC','IV_CRD_CLS') THEN 'MPU_CLASSIC'
                WHEN CARD_CARDPLAN_ID IN ('CRD_GOLD','IV_CRD_GLD','PA_CRD_GLD') THEN 'MPU_GOLD'
                WHEN CARD_CARDPLAN_ID IN ('MU_GOLD','MU_W1Y_GLD') THEN 'UPI_GOLD'
                WHEN CARD_CARDPLAN_ID IN ('MU_PLATN','MU_PLT_WHF') THEN 'UPI_PLTN'
                END AS CARD_PLAN,
                A.CARD_BS_IND, CARD_PLASTIC_CODE, B.CUST_STATUS_ID, C.CRDACCT_STATUS_ID, A.CARD_APP_DATE, max(CSTMTXN_YYYYMM) as Last_Annual, D.CONTACT_STAFF
                from CZ_CARD A, CZ_CUSTOMER B, CZ_CRDACCT C, CZ_CONTACT D, CZ_CSTMTXN E
                where A.CARD_CUST_ID = B.CUST_ID
                AND SUBSTRING(A.CARD_APP_DATE,5,2) LIKE '$this->month'
                and A.CARD_CUST_ID = C.CRDACCT_CUST_ID
                and B.CUST_ID = D.CONTACT_ID
                and C.CRDACCT_NO = E.CSTMTXN_ACCT_ID
                and CARD_TYPE like 'C'
                and CARD_CARDPLAN_ID like '%CRD_G%'
                and E.CSTMTXN_TYPE in ('CFESY0020','CDAMN00RF')
                and A.CARD_PLASTIC_CODE not in ('V','T','D','E','K')
                group by A.CARD_NO, A.CARD_BS_IND"));
        } elseif ($this->card === 'UPI_GOLD') {
            return collect(DB::connection('mysql2')
                ->select("select CARD_CUST_ID,CARD_NO, CARD_EMBOSSED_NAME, CARD_CRDACCT_NO, CARD_CARDPLAN_ID,
                CASE
                WHEN CARD_CARDPLAN_ID IN ('CRD_CLSC','IV_CRD_CLS') THEN 'MPU_CLASSIC'
                WHEN CARD_CARDPLAN_ID IN ('CRD_GOLD','IV_CRD_GLD','PA_CRD_GLD') THEN 'MPU_GOLD'
                WHEN CARD_CARDPLAN_ID IN ('MU_GOLD','MU_W1Y_GLD') THEN 'UPI_GOLD'
                WHEN CARD_CARDPLAN_ID IN ('MU_PLATN','MU_PLT_WHF') THEN 'UPI_PLTN'
                END AS CARD_PLAN,
                A.CARD_BS_IND, CARD_PLASTIC_CODE, B.CUST_STATUS_ID, C.CRDACCT_STATUS_ID, A.CARD_APP_DATE, max(CSTMTXN_YYYYMM) as Last_Annual, D.CONTACT_STAFF
                from CZ_CARD A, CZ_CUSTOMER B, CZ_CRDACCT C, CZ_CONTACT D, CZ_CSTMTXN E
                where A.CARD_CUST_ID = B.CUST_ID
                AND SUBSTRING(A.CARD_APP_DATE,5,2) LIKE '$this->month'
                and A.CARD_CUST_ID = C.CRDACCT_CUST_ID
                and B.CUST_ID = D.CONTACT_ID
                and C.CRDACCT_NO = E.CSTMTXN_ACCT_ID
                and CARD_TYPE like 'C'
                and CARD_CARDPLAN_ID like '%MU_%D'
                and E.CSTMTXN_TYPE in ('CFESY0020','CDAMN00RF')
                and A.CARD_PLASTIC_CODE not in ('V','T','D','E','K')
                group by A.CARD_NO, A.CARD_BS_IND"));
        } elseif ($this->card === 'UPI_PLT') {
            return collect(DB::connection('mysql2')
                ->select("select CARD_CUST_ID,CARD_NO, CARD_EMBOSSED_NAME, CARD_CRDACCT_NO, CARD_CARDPLAN_ID,
                CASE
                WHEN CARD_CARDPLAN_ID IN ('CRD_CLSC','IV_CRD_CLS') THEN 'MPU_CLASSIC'
                WHEN CARD_CARDPLAN_ID IN ('CRD_GOLD','IV_CRD_GLD','PA_CRD_GLD') THEN 'MPU_GOLD'
                WHEN CARD_CARDPLAN_ID IN ('MU_GOLD','MU_W1Y_GLD') THEN 'UPI_GOLD'
                WHEN CARD_CARDPLAN_ID IN ('MU_PLATN','MU_PLT_WHF') THEN 'UPI_PLTN'
                END AS CARD_PLAN,
                A.CARD_BS_IND, CARD_PLASTIC_CODE, B.CUST_STATUS_ID, C.CRDACCT_STATUS_ID, A.CARD_APP_DATE, max(CSTMTXN_YYYYMM) as Last_Annual, D.CONTACT_STAFF
                from CZ_CARD A, CZ_CUSTOMER B, CZ_CRDACCT C, CZ_CONTACT D, CZ_CSTMTXN E
                where A.CARD_CUST_ID = B.CUST_ID
                AND SUBSTRING(A.CARD_APP_DATE,5,2) LIKE '$this->month'
                and A.CARD_CUST_ID = C.CRDACCT_CUST_ID
                and B.CUST_ID = D.CONTACT_ID
                and C.CRDACCT_NO = E.CSTMTXN_ACCT_ID
                and CARD_TYPE like 'C'
                and CARD_CARDPLAN_ID like '%PL%'
                and E.CSTMTXN_TYPE in ('CFESY0020','CDAMN00RF')
                and A.CARD_PLASTIC_CODE not in ('V','T','D','E','K')
                group by A.CARD_NO, A.CARD_BS_IND"));
        }
    }

    public function headings(): array
    {
        return [
            "CARD_CUST_ID",
            "CARD_EMBOSSED_NAME",
            "CARD_CRDACCT_NO",
            "CARD_CARDPLAN_ID",
            "CARD_PLAN",
            "CARD_BS_IND",
            "CARD_PLASTIC_CODE",
            "CUST_STATUS_ID",
            "CRDACCT_STATUS_ID",
            "CARD_APP_DATE",
            "Last_Annual",
            "CONTACT_STAFF",
        ];
    }
}
