<?php

namespace App\Exports;

use App\Models\PSSD04;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;

class PSSD04Export implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $date;
    function __construct($date)
    {
        $this->date = $date;
    }

    public function map($pssd04): array
    {
        return [
            $pssd04->Report_Date,
            $pssd04->Card_Name,
            $pssd04->Category_of_Card,
            $pssd04->No_of_Used_Card,
            $pssd04->Category_of_Transaction,
            $pssd04->CURRENCY_CODE,
            $pssd04->Source,
            $pssd04->No_of_transactions,
            $pssd04->Transaction_Amount,
            $pssd04->Txn_Amt_MMK,
            $pssd04->Remark,
            $pssd04->Transaction_Amount_USD,
        ];
    }

    public function collection()
    {
        return collect(DB::connection('mysql2')
            ->select("select DATE_FORMAT(DT_04_TXN.AUTHTXN_REQUEST_DATE,'%Y-%m-%d') as Report_Date,
            DT_04_CARD.Card_Name, DT_04_CARD.Category_of_Card, DT_04_CARD.No_of_Used_Card, DT_04_CARD.Category_of_Transaction, 
            case  when DT_04_CARD.CURRENCY_CODE like 'MMK' THEN 'MMK'
                  when DT_04_CARD.CURRENCY_CODE like 'USD' THEN 'USD'
                  when DT_04_CARD.CURRENCY_CODE like 'EUR' THEN 'EUR'
                  when DT_04_CARD.CURRENCY_CODE like 'SGD' THEN 'SGD'
                  when DT_04_CARD.CURRENCY_CODE like 'JPY' THEN 'JPY'
                  when DT_04_CARD.CURRENCY_CODE like 'THB' THEN 'THB'
                  when DT_04_CARD.CURRENCY_CODE like 'CNY' THEN 'CNY'
                  when DT_04_CARD.CURRENCY_CODE like 'MYR' THEN 'MYR'
            ELSE 'USD'
            end as CURRENCY_CODE, DT_04_CARD.Source, DT_04_TXN.No_of_transactions,
            round((DT_04_TXN.Transaction_Amount),2) as Transaction_Amount, 
            round(DT_04_TXN.Transaction_Amount,2) as Txn_Amt_MMK,
            case when DT_04_CARD.CURRENCY_CODE like 'MMK' then concat(C.MarketRate,'USD')
                 when DT_04_CARD.CURRENCY_CODE like 'USD' then concat(C.MarketRate,'USD')
                 when DT_04_CARD.CURRENCY_CODE not like 'MMK' then concat(ROUND(C.MarketRate,2),'USD','/','1',DT_04_CARD.CURRENCY_CODE,'=',ROUND(DT_04_CARD.AUTHTXN_FOREX_RATE,2),'MMK')
                 when DT_04_CARD.CURRENCY_CODE not like 'USD' then concat(ROUND(C.MarketRate,2),'USD','/','1',DT_04_CARD.CURRENCY_CODE,'=',ROUND(DT_04_CARD.AUTHTXN_FOREX_RATE,2),'MMK')
            end as Remark,round((DT_04_TXN.Transaction_Amount/C.MarketRate),2) as Transaction_Amount_USD
            from
            (select AUTHTXN_FOREX_RATE,AUTHTXN_REQUEST_DATE,Card_Name, Category_of_Card, Category_of_Transaction, CURRENCY_CODE, Source,count(*) as No_of_Used_Card  from 
            (select AUTHTXN_FOREX_RATE,AUTHTXN_REQUEST_DATE, A.AUTHTXN_CARD_NO,
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
                end as Category_of_Transaction,B.CURRENCY_CODE,
             case when AUTHTXN_TXNTYPE_ID like 'WITHD%' then 'ATM'
                  when AUTHTXN_TXNTYPE_ID like 'CTRFER' then 'ATM'
                  when AUTHTXN_TXNTYPE_ID in ('AUTH','SALES','AUTH_CA','AUTH_CU') then 'POS'
                  when AUTHTXN_TXNTYPE_ID in ('SALE_ECOM','AUTH_ECOM') then 'E-Commerce'
             end as Source 
            from CZ_AUTHTXN A, CZ_CURRENCY B
            where A.AUTHTXN_CURRENCY_CODE = B.CURRENCY_ID
            and AUTHTXN_CARDHOLDER_NAME is not null
            and AUTHTXN_REQUEST_DATE like $this->date
            and AUTHTXN_APPROVED_AMT > 0.00
            and AUTHTXN_RESPONSE_CODE like '00'
            and AUTHTXN_TXNTYPE_ID not like 'ACCTVER%'
            and A.AUTHTXN_SETTLED_IND like 'Y'
            group by A.AUTHTXN_CARD_NO,AUTHTXN_TYPE, B.CURRENCY_ID,AUTHTXN_TXNTYPE_ID, AUTHTXN_REQUEST_DATE,AUTHTXN_CRDPLAN_ID,CURRENCY_CODE ) B
            group by Card_Name, Category_of_Card, Category_of_Transaction, CURRENCY_CODE, Source, AUTHTXN_REQUEST_DATE
            order by AUTHTXN_REQUEST_DATE, Card_Name, Category_of_Card, Category_of_Transaction, Source)DT_04_CARD,
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
                end as Category_of_Transaction,B.CURRENCY_CODE,
             case when AUTHTXN_TXNTYPE_ID like 'WITHD%' then 'ATM'
                  when AUTHTXN_TXNTYPE_ID like 'CTRFER' then 'ATM'
                  when AUTHTXN_TXNTYPE_ID in ('AUTH','SALES','AUTH_CA','AUTH_CU') then 'POS'
                  when AUTHTXN_TXNTYPE_ID in ('SALE_ECOM','AUTH_ECOM') then 'E-Commerce'
             end as Source,count(*) as No_of_transactions, sum(AUTHTXN_APPROVED_AMT) as Transaction_Amount
             from CZ_AUTHTXN A, CZ_CURRENCY B
            where A.AUTHTXN_CURRENCY_CODE = B.CURRENCY_ID
            and AUTHTXN_CARDHOLDER_NAME is not null
            and AUTHTXN_REQUEST_DATE like $this->date
            and AUTHTXN_APPROVED_AMT > 0.00
            and AUTHTXN_RESPONSE_CODE like '00'
            and AUTHTXN_TXNTYPE_ID not like 'ACCTVER%'
            and A.AUTHTXN_SETTLED_IND like 'Y'
            group by AUTHTXN_CRDPLAN_ID,AUTHTXN_TXNTYPE_ID,AUTHTXN_TYPE,CURRENCY_CODE, A.AUTHTXN_REQUEST_DATE)A
            group by Card_Name, Category_of_Card, Category_of_Transaction, Source, CURRENCY_CODE,AUTHTXN_REQUEST_DATE
            order by AUTHTXN_REQUEST_DATE, Card_Name, Category_of_Card, Category_of_Transaction, Source)DT_04_TXN, KCN_EXCHANGE C
            where DT_04_CARD.Card_Name = DT_04_TXN.Card_Name
            and DT_04_CARD.Category_of_Card = DT_04_TXN.Category_of_Card
            and DT_04_CARD.Category_of_Transaction = DT_04_TXN.Category_of_Transaction
            and DT_04_CARD.CURRENCY_CODE = DT_04_TXN.CURRENCY_CODE
            and DT_04_CARD.Source = DT_04_TXN.Source
            and DT_04_TXN.AUTHTXN_REQUEST_DATE = C.CurrencyDate
            and DT_04_TXN.AUTHTXN_REQUEST_DATE = DT_04_CARD.AUTHTXN_REQUEST_DATE"));
    }

    public function headings(): array
    {
        return [
            "Report Date",
            "Card Name ",
            "Category of Card",
            "No of Used Card",
            "Category of Transaction",
            "CURRENCY CODE",
            "Source",
            "No of transactions",
            "Transaction Amount",
            "Transaction Amount MMK",
            "Remark",
            "Transaction Amount USD"
        ];
    }
}