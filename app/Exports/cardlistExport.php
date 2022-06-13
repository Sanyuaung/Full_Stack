<?php

namespace App\Exports;

use App\Models\cardlist;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class cardlistExport implements FromCollection,WithHeadings,WithMapping,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $startdate,$enddate,$brand;
    function __construct($startdate,$enddate,$brand)
    {
        $this->startdate=$startdate;
        $this->enddate=$enddate;
        $this->brand=$brand;
    }
    public function map($card): array
    {
        return [
            $card->Date,
            $card->CARD_BRANCH_ID,
            $card->CARD_CARDPLAN_ID,
            $card->Count,
        ];
    }
    
    public function collection()
    {
        if ($this->brand==='MPU_DEBIT') {
            return collect(DB::connection('mysql2')
        ->select("select  @row:=@row + 1 AS NO, 'Between  $this->startdate and $this->enddate' as Date,
        CARD_BRANCH_ID,CARD_CARDPLAN_ID,count(*) as Count
        from CZ_CARD 
       where CARD_CARDPLAN_ID like 'MPU_DEBIT'
       and CARD_ANNIVERSARY_DATE between $this->startdate and $this->enddate
       and CARD_APP_DATE is null
       group by CARD_BRANCH_ID"));
        }else{
            return collect(DB::connection('mysql2')
        ->select("select  @row:=@row + 1 AS NO,'Between  $this->startdate and $this->enddate' as Date,
        CARD_BRANCH_ID,CARD_CARDPLAN_ID,count(*) as Count
        from CZ_CARD 
       where  CARD_CARDPLAN_ID like 'MOB_UPI_DB'
       and CARD_ANNIVERSARY_DATE between $this->startdate and $this->enddate
       group by CARD_BRANCH_ID"));
        }
    }

    public function headings():array
    {
        return ["Date","CARD_BRANCH_ID","CARD_CARDPLAN_ID","Count"];
    }
}