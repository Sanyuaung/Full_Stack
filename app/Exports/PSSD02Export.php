<?php

namespace App\Exports;

use App\Models\PSSD02;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;

class PSSD02Export implements FromCollection,WithHeadings,WithMapping,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $date;
    function __construct($date)
    {
        $this->date = $date;
    }
    
    public function map($pssd02): array
    {
        return [
            $pssd02->Report_Date,
            $pssd02->Card_Name,
            $pssd02->Transaction_Date,
            $pssd02->Category_of_Card,
            $pssd02->CURRENCY,
            $pssd02->Source,
            $pssd02->Used_Location,
            $pssd02->Number_of_Acquire_Transaction,
            $pssd02->Acquire_Transaction_Amount,
            $pssd02->Acquire_Transaction_Amount_USD,
            $pssd02->Acquire_Transaction_Amount_MMK,
            $pssd02->Commision_Amount,
            $pssd02->Commision_Amount_USD,
            $pssd02->Commision_Amount_MMK,
            $pssd02->Remark
        ];
    }
    
    public function collection()
    {
        return collect(DB::connection('mysql2')
        ->select("select DATE_FORMAT($this->date,'%Y-%m-%d') as Report_Date,
        CASE
        WHEN A.AUTHTXN_CRDPLAN_ID LIKE 'JCB%' THEN 'JCB'
        WHEN A.AUTHTXN_CRDPLAN_ID LIKE 'UPI%' THEN 'UPI'
        WHEN A.AUTHTXN_CRDPLAN_ID LIKE 'VSI%' THEN 'VISA'
        WHEN A.AUTHTXN_CRDPLAN_ID LIKE 'MCI%' THEN 'MASTER'
        ELSE
        'MPU'
        END AS Card_Name,DATE_FORMAT($this->date,'%Y-%m-%d') AS Transaction_Date,
        CASE when AUTHTXN_CRDPLAN_ID like '%CRD%' then 'Credit'
            when A.AUTHTXN_CRDPLAN_ID like '%DEBIT%' then 'Debit'
            when A.AUTHTXN_CRDPLAN_ID like 'MU%' then 'Co-brand'
            when A.AUTHTXN_CRDPLAN_ID like 'MOB_UPI_DB%' then 'Co-brand' 
            WHEN B.PAN LIKE C.BIN_Code THEN C.Card_Type
            ELSE 'CREDIT'
        END as Category_of_Card, D.CURRENCY_CODE AS CURRENCY,
        CASE when A.AUTHTXN_TXNTYPE_ID like 'WITHD%' then 'ATM'
            when A.AUTHTXN_TXNTYPE_ID like 'CTRFER' then 'ATM'
            when A.AUTHTXN_TXNTYPE_ID in ('AUTH','SALES','AUTH_CA','AUTH_CU') then 'POS'
            when A.AUTHTXN_TXNTYPE_ID in ('SALE_ECOM','AUTH_ECOM') then 'E-Commerce'
        END AS Source,
        case 
            when D.CURRENCY_CODE like 'MMK' then 'Local' 
            else 'Oversea' 
        end as Used_Location,
        count(*) AS Number_of_Acquire_Transaction,
        Round(sum(B.Amount_Transaction),2) AS Acquire_Transaction_Amount,
        Round(sum(B.Amount_Transaction/E.MarketRate),2) AS Acquire_Transaction_Amount_USD,
        ROUND(sum(CASE
            WHEN D.CURRENCY_CODE like 'MMK' THEN B.Amount_Transaction
            WHEN D.CURRENCY_CODE NOT like 'MMK' THEN B.Amount_Transaction * E.MarketRate
        END),2) AS Acquire_Transaction_Amount_MMK,
        sum(CASE
            WHEN A.AUTHTXN_RETRIEVAL_REFNO LIKE B.RRN THEN Round(((-A.AUTHTXN_MERC_MDR_AMT) - B.COMMISSION_AMT),2)
            END) AS Commision_Amount,
        sum(CASE
            WHEN A.AUTHTXN_RETRIEVAL_REFNO LIKE B.RRN THEN Round((((-A.AUTHTXN_MERC_MDR_AMT) - B.COMMISSION_AMT)/E.MarketRate),2)
            END) AS Commision_Amount_USD,
        sum(CASE
            WHEN B.Merchant_Country_Code LIKE '104%' THEN Round(((-A.AUTHTXN_MERC_MDR_AMT) - B.COMMISSION_AMT),2)
        END) AS Commision_Amount_MMK,E.MarketRate as Remark
        FROM (SELECT AUTHTXN_APPROVAL_CODE,AUTHTXN_APPROVED_AMT,AUTHTXN_CRDPLAN_ID,AUTHTXN_TXNTYPE_ID,AUTHTXN_MERC_MDR_AMT,AUTHTXN_RETRIEVAL_REFNO,AUTHTXN_CURRENCY_CODE FROM CZ_AUTHTXN
        WHERE AUTHTXN_RESPONSE_CODE like '00'
        AND AUTHTXN_TXNTYPE_ID like 'SALES' ) A RIGHT JOIN 
        (SELECT substring(Field1,7,6) as PAN,substring(Field1,93,12) AS RRN,concat(substring(Field1,264,10),'.',substring(Field1,274,2)) AS COMMISSION_AMT,
        substring(Field1,246,3) as Merchant_Country_Code,
        substring(Field1,83,6) as AuthorizationIdentificationresponse,concat(substring(Field1,29,10),'.',substring(Field1,39,2)) as Amount_Transaction FROM SYA_INC) B
        ON A.AUTHTXN_RETRIEVAL_REFNO = B.RRN
        -- ON A.AUTHTXN_APPROVAL_CODE = B.AuthorizationIdentificationresponse
        LEFT JOIN SYA_BIN C
        ON B.PAN = C.BIN_Code
        LEFT JOIN CZ_CURRENCY D
        ON A.AUTHTXN_CURRENCY_CODE = D.CURRENCY_ID
        LEFT JOIN KCN_EXCHANGE E
        ON E.CurrencyDate = $this->date
        group by A.AUTHTXN_CURRENCY_CODE, Category_of_Card

    union

        select DATE_FORMAT($this->date,'%Y-%m-%d') as Report_Date,
                CASE
                WHEN A.AUTHTXN_CRDPLAN_ID LIKE 'JCB%' THEN 'JCB'
                WHEN A.AUTHTXN_CRDPLAN_ID LIKE 'UPI%' THEN 'UPI'
                WHEN A.AUTHTXN_CRDPLAN_ID LIKE 'VSI%' THEN 'VISA'
                WHEN A.AUTHTXN_CRDPLAN_ID LIKE 'MCI%' THEN 'MASTER'
                ELSE
                'MPU'
                END AS Card_Name, DATE_FORMAT($this->date,'%Y-%m-%d') as Transaction_Date,
                CASE when AUTHTXN_CRDPLAN_ID like '%CRD%' then 'Credit'
                when A.AUTHTXN_CRDPLAN_ID like '%DEBIT%' then 'Debit'
                when A.AUTHTXN_CRDPLAN_ID like 'MU%' then 'Co-brand'
                when A.AUTHTXN_CRDPLAN_ID like 'MOB_UPI_DB%' then 'Co-brand' 
                WHEN B.PAN LIKE C.BIN_Code THEN C.Card_Type
                ELSE 'CREDIT'
                END as Category_of_Card, D.CURRENCY_CODE AS Currency,
                CASE 
                WHEN A.AUTHTXN_TXNTYPE_ID like 'WITHD%' then 'ATM'
                WHEN A.AUTHTXN_TXNTYPE_ID like 'CTRFER' then 'ATM'
                WHEN A.AUTHTXN_TXNTYPE_ID in ('AUTH','SALES','AUTH_CA','AUTH_CU') then 'POS'
                WHEN A.AUTHTXN_TXNTYPE_ID in ('SALE_ECOM','AUTH_ECOM') then 'E-Commerce'
                END as Source,  case 
                when D.CURRENCY_CODE like 'MMK' then 'Local' 
                else 'Oversea' 
                end as Used_Location,count(*) AS Number_of_Acquire_Transaction,
            sum(case
            when D.CURRENCY_CODE like 'MMK' THEN Round((A.AUTHTXN_APPROVED_AMT),2)
            when D.CURRENCY_CODE not like 'MMK' THEN Round((A.AUTHTXN_APPROVED_AMT * E.MarketRate),2)
            end) AS Acquire_Transaction_Amount,
            sum(case
            when D.CURRENCY_CODE like 'MMK' THEN Round((A.AUTHTXN_APPROVED_AMT/E.MarketRate),2)
            when D.CURRENCY_CODE not like 'MMK' THEN Round(A.AUTHTXN_REQUEST_AMT,2)
            end) AS Acquire_Transaction_Amount_USD,
            SUM(CASE
                WHEN D.CURRENCY_CODE like 'MMK' THEN Round(A.AUTHTXN_APPROVED_AMT,2)
                WHEN D.CURRENCY_CODE NOT like 'MMK' THEN Round((A.AUTHTXN_APPROVED_AMT * E.MarketRate),2)
                end) AS Acquire_Transaction_Amount_MMK,
            SUM(
            CASE
            WHEN A.AUTHTXN_GEOGRAPHY_IND LIKE 'IC' THEN Round(A.AUTHTXN_FEE,2)
            WHEN A.AUTHTXN_GEOGRAPHY_IND NOT LIKE 'IC' THEN Round(B.FEE,2)
            END) AS Commission_Amount,
            SUM(
            CASE
            WHEN A.AUTHTXN_GEOGRAPHY_IND LIKE 'IC' THEN Round((A.AUTHTXN_FEE/E.MarketRate),2)
            WHEN A.AUTHTXN_GEOGRAPHY_IND NOT LIKE 'IC' THEN Round((B.FEE/E.MarketRate),2)
            END) AS Commission_Amount_USD,
            SUM(
            CASE
            WHEN A.AUTHTXN_GEOGRAPHY_IND LIKE 'IC' THEN Round(A.AUTHTXN_FEE,2)
            WHEN A.AUTHTXN_GEOGRAPHY_IND NOT LIKE 'IC' THEN Round(B.FEE,2)
            END) AS Commission_Amount_MMK,E.MarketRate as Remark
            FROM  (SELECT AUTHTXN_CRDPLAN_ID,AUTHTXN_TXNTYPE_ID,AUTHTXN_APPROVED_AMT,AUTHTXN_GEOGRAPHY_IND,AUTHTXN_FEE,
                AUTHTXN_RETRIEVAL_REFNO,AUTHTXN_REQUEST_AMT,AUTHTXN_CURRENCY_CODE FROM CZ_AUTHTXN 
                where AUTHTXN_Source LIKE 'ATM'
                AND AUTHTXN_DEST IN ('VAP-PRI-SMS-CHANNEL','MPS-CHANNEL')
                AND AUTHTXN_TXNTYPE_ID LIKE 'WITHD%'
                AND AUTHTXN_REQUEST_AMT > 0
                AND AUTHTXN_TXNTYPE_ID NOT LIKE 'R%'
                AND AUTHTXN_TXNTYPE_ID NOT LIKE 'ACC%'
                AND AUTHTXN_TXNTYPE_ID NOT LIKE 'V%'
                AND AUTHTXN_RESPONSE_CODE = '00') AS A INNER JOIN (SELECT trim(substring(Field1,4,9)) as PAN,substring(Field1,138,12) as RRN_1,
            concat(substring(Field1,229,10),'.',substring(Field1,239,2)) as FEE FROM SYA_ACOM)AS B
            ON A.AUTHTXN_RETRIEVAL_REFNO = B.RRN_1
            LEFT JOIN SYA_BIN C
            ON B.PAN = C.BIN_Code
            LEFT JOIN CZ_CURRENCY D
            ON A.AUTHTXN_CURRENCY_CODE = D.CURRENCY_ID
            LEFT JOIN KCN_EXCHANGE E
            ON E.CurrencyDate = $this->date
            GROUP BY Source,Card_Name,Currency,Category_of_Card

    union

        select DATE_FORMAT($this->date,'%Y-%m-%d') as Report_Date,
                CASE
                WHEN typeOfTrans LIKE 'VISA%' THEN 'VISA'
                WHEN typeOfTrans LIKE 'UPI%' THEN 'UPI'
                WHEN typeOfTrans LIKE 'JCB%' THEN 'JCB'
                WHEN typeOfTrans LIKE 'Master%' THEN 'MASTER'
                ELSE
                'MPU'
                END AS Card_Name,DATE_FORMAT($this->date,'%Y-%m-%d') AS Transaction_Date,
                CASE 
                WHEN cardType like 'Credit' Then cardType
                WHEN cardType not like 'Credit' Then 'Debit'
                END
                as Category_of_Card, 
                currency AS Currency,
                CASE
                    WHEN typeOfTrans LIKE '%POS' then 'POS'
                    WHEN typeOfTrans LIKE '%ATM' then 'ATM'
                END AS Source,'Local'as Used_Location,
                SUM(noTrans) AS Number_of_Acquire_Transaction,
                case
                  when currency like 'MMK' then mmkAmt
                  when currency like 'USD' then usdAmt
                end as Acquire_Transaction_Amount,
                Round(sum(usdAmt),2) AS Acquire_Transaction_Amount_USD,
                Round(sum(mmkAmt),2) AS Acquire_Transaction_Amount_MMK,
                Round(sum(commAmt),2) AS Commission_Amount,
                Round(sum(commAmt/exRate),2) AS Commission_Amount_USD,
                Round(sum(commAmt),2) AS Commission_Amount_MMK,
                exRate as remark FROM syavisatrans WHERE settleDate = $this->date group by Category_of_Card
                
    union
                
        select DATE_FORMAT($this->date,'%Y-%m-%d') as Report_Date,
        CASE
        WHEN A.AUTHTXN_CRDPLAN_ID LIKE 'JCB%' THEN 'JCB'
        WHEN A.AUTHTXN_CRDPLAN_ID LIKE 'UPI%' THEN 'UPI'
        WHEN A.AUTHTXN_CRDPLAN_ID LIKE 'VSI%' THEN 'VISA'
        WHEN A.AUTHTXN_CRDPLAN_ID LIKE 'MCI%' THEN 'MASTER'
        ELSE
        'MPU'
        END AS Card_Name,DATE_FORMAT($this->date,'%Y-%m-%d') AS Transaction_Date,
        CASE when AUTHTXN_CRDPLAN_ID like '%CRD%' then 'Credit'
            when A.AUTHTXN_CRDPLAN_ID like '%DEBIT%' then 'Debit'
            when A.AUTHTXN_CRDPLAN_ID like 'MU%' then 'Co-brand'
            when A.AUTHTXN_CRDPLAN_ID like 'MOB_UPI_DB%' then 'Co-brand' 
            WHEN B.PAN LIKE C.BIN_Code THEN C.Card_Type
            else 'Credit'
        END as Category_of_Card, D.CURRENCY_CODE AS CURRENCY,
        CASE when A.AUTHTXN_TXNTYPE_ID like 'WITHD%' then 'ATM'
            when A.AUTHTXN_TXNTYPE_ID like 'CTRFER' then 'ATM'
            when A.AUTHTXN_TXNTYPE_ID in ('AUTH','SALES','AUTH_CA','AUTH_CU') then 'POS'
            when A.AUTHTXN_TXNTYPE_ID in ('SALE_ECOM','AUTH_ECOM') then 'E-Commerce'
        END AS Source,
        case 
            when D.CURRENCY_CODE like 'MMK' then 'Local' 
            else 'Oversea' 
        end as Used_Location,
        count(*) AS Number_of_Acquire_Transaction,
        Round(sum(B.Amount_Transaction),2) AS Acquire_Transaction_Amount,
        Round(sum(B.Amount_Transaction/E.MarketRate),2) AS Acquire_Transaction_Amount_USD,
        ROUND(sum(CASE
            WHEN D.CURRENCY_CODE like 'MMK' THEN B.Amount_Transaction
            WHEN D.CURRENCY_CODE NOT like 'MMK' THEN B.Amount_Transaction * E.MarketRate
        END),2) AS Acquire_Transaction_Amount_MMK,
        sum(CASE
            WHEN A.AUTHTXN_RETRIEVAL_REFNO LIKE B.RRN THEN Round(((-A.AUTHTXN_MERC_MDR_AMT) - B.COMMISSION_AMT),2)
            END) AS Commision_Amount,
        sum(CASE
            WHEN A.AUTHTXN_RETRIEVAL_REFNO LIKE B.RRN THEN Round((((-A.AUTHTXN_MERC_MDR_AMT) - B.COMMISSION_AMT)/E.MarketRate),2)
            END) AS Commision_Amount_USD,
        sum(CASE
            WHEN B.Merchant_Country_Code LIKE '104%' THEN Round(((-A.AUTHTXN_MERC_MDR_AMT) - B.COMMISSION_AMT),2)
        END) AS Commision_Amount_MMK,E.MarketRate as Remark
        FROM (SELECT AUTHTXN_APPROVAL_CODE,AUTHTXN_APPROVED_AMT,AUTHTXN_CRDPLAN_ID,AUTHTXN_TXNTYPE_ID,AUTHTXN_MERC_MDR_AMT,AUTHTXN_RETRIEVAL_REFNO,AUTHTXN_CURRENCY_CODE FROM CZ_AUTHTXN
        WHERE AUTHTXN_RESPONSE_CODE like '00'
        AND AUTHTXN_TXNTYPE_ID like 'SALES' ) A RIGHT JOIN 
        (SELECT substring(Field1,7,6) as PAN,substring(Field1,95,12) AS RRN,concat(substring(Field1,266,10),'.',substring(Field1,276,2)) AS COMMISSION_AMT,
        substring(Field1,63,3) as Merchant_Country_Code,
        substring(Field1,85,6) as AuthorizationIdentificationresponse,concat(substring(Field1,29,10),'.',substring(Field1,39,2)) as Amount_Transaction FROM SYA_IJC) B
        ON A.AUTHTXN_RETRIEVAL_REFNO = B.RRN
        -- ON A.AUTHTXN_APPROVAL_CODE = B.AuthorizationIdentificationresponse
        LEFT JOIN SYA_BIN C
        ON B.PAN = C.BIN_Code
        LEFT JOIN CZ_CURRENCY D
        ON A.AUTHTXN_CURRENCY_CODE = D.CURRENCY_ID
        LEFT JOIN KCN_EXCHANGE E
        ON E.CurrencyDate = $this->date
        group by A.AUTHTXN_CURRENCY_CODE, Category_of_Card
    
    union
        select DATE_FORMAT($this->date,'%Y-%m-%d') as Report_Date,
        CASE
        WHEN A.AUTHTXN_CRDPLAN_ID LIKE 'JCB%' THEN 'JCB'
        WHEN A.AUTHTXN_CRDPLAN_ID LIKE 'UPI%' THEN 'UPI'
        WHEN A.AUTHTXN_CRDPLAN_ID LIKE 'VSI%' THEN 'VISA'
        WHEN A.AUTHTXN_CRDPLAN_ID LIKE 'MCI%' THEN 'MASTER'
        ELSE
        'MPU'
        END AS Card_Name,DATE_FORMAT($this->date,'%Y-%m-%d') AS Transaction_Date,
        CASE when AUTHTXN_CRDPLAN_ID like '%CRD%' then 'Credit'
            when A.AUTHTXN_CRDPLAN_ID like '%DEBIT%' then 'Debit'
            when A.AUTHTXN_CRDPLAN_ID like 'MU%' then 'Co-brand'
            when A.AUTHTXN_CRDPLAN_ID like 'MOB_UPI_DB%' then 'Co-brand' 
            WHEN B.PAN LIKE C.BIN_Code THEN C.Card_Type
            else 'Credit'
        END as Category_of_Card, D.CURRENCY_CODE AS CURRENCY,
        CASE when A.AUTHTXN_TXNTYPE_ID like 'WITHD%' then 'ATM'
            when A.AUTHTXN_TXNTYPE_ID like 'CTRFER' then 'ATM'
            when A.AUTHTXN_TXNTYPE_ID in ('AUTH','SALES','AUTH_CA','AUTH_CU') then 'POS'
            when A.AUTHTXN_TXNTYPE_ID in ('SALE_ECOM','AUTH_ECOM') then 'E-Commerce'
        END AS Source,
        case 
            when D.CURRENCY_CODE like 'MMK' then 'Local' 
            else 'Oversea' 
        end as Used_Location,
        count(*) AS Number_of_Acquire_Transaction,
        Round(sum(B.Amount_Transaction),2) AS Acquire_Transaction_Amount,
        Round(sum(B.Amount_Transaction/E.MarketRate),2) AS Acquire_Transaction_Amount_USD,
        ROUND(sum(CASE
            WHEN D.CURRENCY_CODE like 'MMK' THEN B.Amount_Transaction
            WHEN D.CURRENCY_CODE NOT like 'MMK' THEN B.Amount_Transaction * E.MarketRate
        END),2) AS Acquire_Transaction_Amount_MMK,
        sum(CASE
            WHEN A.AUTHTXN_RETRIEVAL_REFNO LIKE B.RRN THEN Round(((-A.AUTHTXN_MERC_MDR_AMT) - B.COMMISSION_AMT),2)
            END) AS Commision_Amount,
        sum(CASE
            WHEN A.AUTHTXN_RETRIEVAL_REFNO LIKE B.RRN THEN Round((((-A.AUTHTXN_MERC_MDR_AMT) - B.COMMISSION_AMT)/E.MarketRate),2)
            END) AS Commision_Amount_USD,
        sum(CASE
            WHEN B.Merchant_Country_Code LIKE '104%' THEN Round(((-A.AUTHTXN_MERC_MDR_AMT) - B.COMMISSION_AMT),2)
        END) AS Commision_Amount_MMK,E.MarketRate as Remark
        FROM (SELECT AUTHTXN_APPROVAL_CODE,AUTHTXN_APPROVED_AMT,AUTHTXN_CRDPLAN_ID,AUTHTXN_TXNTYPE_ID,AUTHTXN_MERC_MDR_AMT,AUTHTXN_RETRIEVAL_REFNO,AUTHTXN_CURRENCY_CODE FROM CZ_AUTHTXN
        WHERE AUTHTXN_RESPONSE_CODE like '00'
        AND AUTHTXN_TXNTYPE_ID like 'SALES' ) A RIGHT JOIN 
        (SELECT substring(Field1,7,6) as PAN,substring(Field1,93,12) AS RRN,concat(substring(Field1,264,6),'.',substring(Field1,270,6)) AS COMMISSION_AMT,
        substring(Field1,61,3) as Merchant_Country_Code,
        substring(Field1,83,6) as AuthorizationIdentificationresponse,concat(substring(Field1,29,10),'.',substring(Field1,39,2)) as Amount_Transaction FROM SYA_IUC) B
        ON A.AUTHTXN_RETRIEVAL_REFNO = B.RRN
        -- ON A.AUTHTXN_APPROVAL_CODE = B.AuthorizationIdentificationresponse
        LEFT JOIN SYA_BIN C
        ON B.PAN = C.BIN_Code
        LEFT JOIN CZ_CURRENCY D
        ON A.AUTHTXN_CURRENCY_CODE = D.CURRENCY_ID
        LEFT JOIN KCN_EXCHANGE E
        ON E.CurrencyDate = $this->date
        group by A.AUTHTXN_CURRENCY_CODE, Category_of_Card"));
    }

    public function headings():array
    {
        return ["Report_Date",
                "Card_Name" ,
                "Transaction_Date" ,
                "Category_of_Card" ,
                "CURRENCY" ,
                "Source" ,
                "Used_Location" ,
                "Number_of_Acquire_Transction" ,
                "Acquire_Transaction_Amount",
                "Acquire_Transaction_Amount_USD",
                "Acquire_Transaction_Amount_MMK" ,
                "Commision_Amount",
                "Commision_Amount_USD",
                "Commision_Amount_MMK" ,
                "Remark"];
    }
    
}