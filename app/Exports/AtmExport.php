<?php

namespace App\Exports;

use App\Models\Atm;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AtmExport implements FromCollection,WithHeadings,WithMapping,ShouldAutoSize

{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $startdate,$enddate;
    function __construct($startdate,$enddate,$count)
    {
        $this->startdate=$startdate;
        $this->enddate=$enddate;
        $this->count=$count;
    }
    
    public function map($atm): array
    {
        return [

            $atm->ATM_ID,
            $atm->ATM_LOCATION,
            $atm->DOWNTIME,
            $atm->DOWNTIME_PERCENT,
            $atm->AVALIABLE_PERCENT,
        ];
    }
    
    public function collection()
    {
        return collect(DB::connection('mysql2')
        ->select("select B.ATM_ID AS ATM_ID, B.ATM_LOCATION, 
         IFNULL(concat(hour(SEC_TO_TIME(SUM(A.ATMDOWN_DURATION)*3600)),':',minute(SEC_TO_TIME(SUM(A.ATMDOWN_DURATION)*3600)),
        ':',second(SEC_TO_TIME(SUM(A.ATMDOWN_DURATION)*3600))),'$this->count:00:00') as DOWNTIME,
        IFNULL(ROUND((SUM(A.ATMDOWN_DURATION)/$this->count)*100,2),'100') AS DOWNTIME_PERCENT,
        IFNULL(ROUND(100-((SUM(A.ATMDOWN_DURATION)/$this->count)*100),2),'0') AS AVALIABLE_PERCENT
        from CZ_ATMDOWN A right join CZ_ATM B ON A.ATMDOWN_ATM_ID= B.ATM_ID 
        AND A.ATMDOWN_DATE>=$this->startdate AND A.ATMDOWN_DATE<=$this->enddate GROUP BY B.ATM_ID,B.ATM_LOCATION"));
    }

    public function headings():array
    {
        return ["ATM ID","ATM Location","Downtime","Downtime Percentage","Available Percentage"];
    }
}