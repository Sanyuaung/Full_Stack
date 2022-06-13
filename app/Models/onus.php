<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class onus extends Model
{
    use HasFactory;
    public static function onus(Request $req)
    {
        $validation=$req->validate([
            "startdate"=>"required",
            "enddate"=>"required",
        ]);
        $startdate=substr($req->startdate, 0, 4).substr($req->startdate, 5, 2).substr($req->startdate, 8, 2);
        $enddate=substr($req->enddate, 0, 4).substr($req->enddate, 5, 2).substr($req->enddate, 8, 2);
        if ($validation) {
            DB::connection('mysql2')->statement(DB::raw('set @row:=0'));
            $onus = DB::connection('mysql2')->select("select substring(AUTHTXN_REQUEST_DATE,1,6) as Month,Card_Name, 
            Category_of_Transaction, Source,sum(No_of_transactions) as No_of_transactions , sum(Transaction_Amount) as Transaction_Amount from
            (select AUTHTXN_REQUEST_DATE, Card_Name, Category_of_Card,'' as No_of_Issued_cards, Category_of_Transaction,CURRENCY_CODE,Source,
            sum(No_of_transactions) as No_of_transactions,sum(Transaction_Amount) as Transaction_Amount from
            (select AUTHTXN_REQUEST_DATE,
            case when AUTHTXN_CRDPLAN_ID like '%CRD%' then 'MPU'
                 when AUTHTXN_CRDPLAN_ID like '%MPU_DEBIT%' then 'MPU'
                 when AUTHTXN_CRDPLAN_ID like 'CORP_DEBIT' then 'MPU'
                 when AUTHTXN_CRDPLAN_ID like '%MU%' then 'UPI'
                 when AUTHTXN_CRDPLAN_ID like '%MOB_UPI_DB%' then 'UPI' 
                 end as Card_Name,
            case when AUTHTXN_CRDPLAN_ID like '%CRD%' then 'Credit'
                 when AUTHTXN_CRDPLAN_ID like '%MPU_DEBIT%' then 'Debit'
                 when AUTHTXN_CRDPLAN_ID like 'CORP_DEBIT' then 'Debit'
                 when AUTHTXN_CRDPLAN_ID like '%MU%' then 'Co-brand'
                 when AUTHTXN_CRDPLAN_ID like '%MOB_UPI_DB%' then 'Co-brand' 
                 end as Category_of_Card,'' as No_of_Issued_cards,
                 case when AUTHTXN_TYPE like 'OFFUS' then 'Off-us'
                  else 'On-us'
                end as Category_of_Transaction, B.CURRENCY_CODE,
             case when AUTHTXN_TXNTYPE_ID like 'WITHD%' then 'ATM'
                  when AUTHTXN_TXNTYPE_ID in ('AUTH','SALES','AUTH_CA','AUTH_CU','CASHADV') then 'POS'
                  when AUTHTXN_TXNTYPE_ID in ('SALE_ECOM','AUTH_ECOM') then 'E-Commerce'
             end as Source,count(*)
             as No_of_transactions, sum(AUTHTXN_APPROVED_AMT) as Transaction_Amount
             from CZ_AUTHTXN A, CZ_CURRENCY B
            where A.AUTHTXN_CURRENCY_CODE = B.CURRENCY_ID
            and AUTHTXN_CARDHOLDER_NAME is not null
            and AUTHTXN_REQUEST_DATE between $startdate and $enddate
            and AUTHTXN_APPROVED_AMT > 0.00
            and AUTHTXN_RESPONSE_CODE like '00'
            and AUTHTXN_TXNTYPE_ID not like 'ACCTVER%'
            and AUTHTXN_TXNTYPE_ID not like 'CTRFER%'
            and A.AUTHTXN_SETTLED_IND like 'Y'
            group by AUTHTXN_CRDPLAN_ID,AUTHTXN_TXNTYPE_ID,AUTHTXN_TYPE,CURRENCY_CODE, A.AUTHTXN_REQUEST_DATE)A
            group by Card_Name, Category_of_Card, Category_of_Transaction, Source, CURRENCY_CODE,AUTHTXN_REQUEST_DATE
            order by AUTHTXN_REQUEST_DATE, Card_Name, Category_of_Card, Category_of_Transaction, Source) A
            where A.Category_of_Transaction = 'On-us'
            group by Card_Name, Source,substring(AUTHTXN_REQUEST_DATE,1,6)
            order by substring(AUTHTXN_REQUEST_DATE,1,6),Source");
            return $onus;
        }
    }
}