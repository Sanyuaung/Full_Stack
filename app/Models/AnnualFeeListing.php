<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnnualFeeListing extends Model
{
    use HasFactory;
    public static function MPU_CLASSIC(Request $req)
    {
        $validation = $req->validate([
            "month" => "required",
            "card" => "required",
        ]);
        $month = $req->month;
        $card = $req->card;
        if ($validation) {
            DB::connection('mysql2')->statement(DB::raw('set @row:=0'));
            $MPU_CLASSIC = DB::connection('mysql2')->select("select CARD_CUST_ID,CARD_NO, CARD_EMBOSSED_NAME, CARD_CRDACCT_NO, CARD_CARDPLAN_ID,
                            CASE
                            WHEN CARD_CARDPLAN_ID IN ('CRD_CLSC','IV_CRD_CLS') THEN 'MPU_CLASSIC'
                            WHEN CARD_CARDPLAN_ID IN ('CRD_GOLD','IV_CRD_GLD','PA_CRD_GLD') THEN 'MPU_GOLD'
                            WHEN CARD_CARDPLAN_ID IN ('MU_GOLD','MU_W1Y_GLD') THEN 'UPI_GOLD'
                            WHEN CARD_CARDPLAN_ID IN ('MU_PLATN','MU_PLT_WHF') THEN 'UPI_PLTN'
                            END AS CARD_PLAN,
                            A.CARD_BS_IND, CARD_PLASTIC_CODE, B.CUST_STATUS_ID, C.CRDACCT_STATUS_ID, A.CARD_APP_DATE, max(CSTMTXN_YYYYMM) as Last_Annual, D.CONTACT_STAFF
                            from CZ_CARD A, CZ_CUSTOMER B, CZ_CRDACCT C, CZ_CONTACT D, CZ_CSTMTXN E
                            where A.CARD_CUST_ID = B.CUST_ID
                            AND SUBSTRING(A.CARD_APP_DATE,5,2) LIKE '$month'
                            and A.CARD_CUST_ID = C.CRDACCT_CUST_ID
                            and B.CUST_ID = D.CONTACT_ID
                            and C.CRDACCT_NO = E.CSTMTXN_ACCT_ID
                            and CARD_TYPE like 'C'
                            and CARD_CARDPLAN_ID like '%CRD_CLS%'
                            and E.CSTMTXN_TYPE in ('CFESY0020','CDAMN00RF')
                            and A.CARD_PLASTIC_CODE not in ('V','T','D','E','K')
                            group by A.CARD_NO, A.CARD_BS_IND");
            return $MPU_CLASSIC;
        }
    }

    public static function MPU_GOLD(Request $req)
    {
        $validation = $req->validate([
            "month" => "required",
            "card" => "required",
        ]);
        $month = $req->month;
        $card = $req->card;
        if ($validation) {
            DB::connection('mysql2')->statement(DB::raw('set @row:=0'));
            $MPU_GOLD = DB::connection('mysql2')->select("select CARD_CUST_ID,CARD_NO, CARD_EMBOSSED_NAME, CARD_CRDACCT_NO, CARD_CARDPLAN_ID,
                            CASE
                            WHEN CARD_CARDPLAN_ID IN ('CRD_CLSC','IV_CRD_CLS') THEN 'MPU_CLASSIC'
                            WHEN CARD_CARDPLAN_ID IN ('CRD_GOLD','IV_CRD_GLD','PA_CRD_GLD') THEN 'MPU_GOLD'
                            WHEN CARD_CARDPLAN_ID IN ('MU_GOLD','MU_W1Y_GLD') THEN 'UPI_GOLD'
                            WHEN CARD_CARDPLAN_ID IN ('MU_PLATN','MU_PLT_WHF') THEN 'UPI_PLTN'
                            END AS CARD_PLAN,
                            A.CARD_BS_IND, CARD_PLASTIC_CODE, B.CUST_STATUS_ID, C.CRDACCT_STATUS_ID, A.CARD_APP_DATE, max(CSTMTXN_YYYYMM) as Last_Annual, D.CONTACT_STAFF
                            from CZ_CARD A, CZ_CUSTOMER B, CZ_CRDACCT C, CZ_CONTACT D, CZ_CSTMTXN E
                            where A.CARD_CUST_ID = B.CUST_ID
                            AND SUBSTRING(A.CARD_APP_DATE,5,2) LIKE '$month'
                            and A.CARD_CUST_ID = C.CRDACCT_CUST_ID
                            and B.CUST_ID = D.CONTACT_ID
                            and C.CRDACCT_NO = E.CSTMTXN_ACCT_ID
                            and CARD_TYPE like 'C'
                            and CARD_CARDPLAN_ID like '%CRD_G%'
                            and E.CSTMTXN_TYPE in ('CFESY0020','CDAMN00RF')
                            and A.CARD_PLASTIC_CODE not in ('V','T','D','E','K')
                            group by A.CARD_NO, A.CARD_BS_IND");
            return $MPU_GOLD;
        }
    }

    public static function UPI_GOLD(Request $req)
    {
        $validation = $req->validate([
            "month" => "required",
            "card" => "required",
        ]);
        $month = $req->month;
        $card = $req->card;
        if ($validation) {
            DB::connection('mysql2')->statement(DB::raw('set @row:=0'));
            $UPI_GOLD = DB::connection('mysql2')->select("select CARD_CUST_ID,CARD_NO, CARD_EMBOSSED_NAME, CARD_CRDACCT_NO, CARD_CARDPLAN_ID,
                            CASE
                            WHEN CARD_CARDPLAN_ID IN ('CRD_CLSC','IV_CRD_CLS') THEN 'MPU_CLASSIC'
                            WHEN CARD_CARDPLAN_ID IN ('CRD_GOLD','IV_CRD_GLD','PA_CRD_GLD') THEN 'MPU_GOLD'
                            WHEN CARD_CARDPLAN_ID IN ('MU_GOLD','MU_W1Y_GLD') THEN 'UPI_GOLD'
                            WHEN CARD_CARDPLAN_ID IN ('MU_PLATN','MU_PLT_WHF') THEN 'UPI_PLTN'
                            END AS CARD_PLAN,
                            A.CARD_BS_IND, CARD_PLASTIC_CODE, B.CUST_STATUS_ID, C.CRDACCT_STATUS_ID, A.CARD_APP_DATE, max(CSTMTXN_YYYYMM) as Last_Annual, D.CONTACT_STAFF
                            from CZ_CARD A, CZ_CUSTOMER B, CZ_CRDACCT C, CZ_CONTACT D, CZ_CSTMTXN E
                            where A.CARD_CUST_ID = B.CUST_ID
                            AND SUBSTRING(A.CARD_APP_DATE,5,2) LIKE '$month'
                            and A.CARD_CUST_ID = C.CRDACCT_CUST_ID
                            and B.CUST_ID = D.CONTACT_ID
                            and C.CRDACCT_NO = E.CSTMTXN_ACCT_ID
                            and CARD_TYPE like 'C'
                            and CARD_CARDPLAN_ID like '%MU_%D'
                            and E.CSTMTXN_TYPE in ('CFESY0020','CDAMN00RF')
                            and A.CARD_PLASTIC_CODE not in ('V','T','D','E','K')
                            group by A.CARD_NO, A.CARD_BS_IND");
            return $UPI_GOLD;
        }
    }

    public static function UPI_PLT(Request $req)
    {
        $validation = $req->validate([
            "month" => "required",
            "card" => "required",
        ]);
        $month = $req->month;
        $card = $req->card;
        if ($validation) {
            DB::connection('mysql2')->statement(DB::raw('set @row:=0'));
            $UPI_PLT = DB::connection('mysql2')->select("select CARD_CUST_ID,CARD_NO, CARD_EMBOSSED_NAME, CARD_CRDACCT_NO, CARD_CARDPLAN_ID,
                            CASE
                            WHEN CARD_CARDPLAN_ID IN ('CRD_CLSC','IV_CRD_CLS') THEN 'MPU_CLASSIC'
                            WHEN CARD_CARDPLAN_ID IN ('CRD_GOLD','IV_CRD_GLD','PA_CRD_GLD') THEN 'MPU_GOLD'
                            WHEN CARD_CARDPLAN_ID IN ('MU_GOLD','MU_W1Y_GLD') THEN 'UPI_GOLD'
                            WHEN CARD_CARDPLAN_ID IN ('MU_PLATN','MU_PLT_WHF') THEN 'UPI_PLTN'
                            END AS CARD_PLAN,
                            A.CARD_BS_IND, CARD_PLASTIC_CODE, B.CUST_STATUS_ID, C.CRDACCT_STATUS_ID, A.CARD_APP_DATE, max(CSTMTXN_YYYYMM) as Last_Annual, D.CONTACT_STAFF
                            from CZ_CARD A, CZ_CUSTOMER B, CZ_CRDACCT C, CZ_CONTACT D, CZ_CSTMTXN E
                            where A.CARD_CUST_ID = B.CUST_ID
                            AND SUBSTRING(A.CARD_APP_DATE,5,2) LIKE '$month'
                            and A.CARD_CUST_ID = C.CRDACCT_CUST_ID
                            and B.CUST_ID = D.CONTACT_ID
                            and C.CRDACCT_NO = E.CSTMTXN_ACCT_ID
                            and CARD_TYPE like 'C'
                            and CARD_CARDPLAN_ID like '%PL%'
                            and E.CSTMTXN_TYPE in ('CFESY0020','CDAMN00RF')
                            and A.CARD_PLASTIC_CODE not in ('V','T','D','E','K')
                            group by A.CARD_NO, A.CARD_BS_IND");
            return $UPI_PLT;
        }
    }
}
