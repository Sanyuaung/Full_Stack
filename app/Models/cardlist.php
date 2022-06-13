<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class cardlist extends Model
{
    use HasFactory;
    public static function MPU_DEBIT(Request $req)
    {
        $validation=$req->validate([
            "startdate"=>"required",
            "enddate"=>"required",
            "brand"=>"required",
        ]);
        $startdate=substr($req->startdate, 0, 4).substr($req->startdate, 5, 2).substr($req->startdate, 8, 2);
        $enddate=substr($req->enddate, 0, 4).substr($req->enddate, 5, 2).substr($req->enddate, 8, 2);
        if ($validation) {
            DB::connection('mysql2')->statement(DB::raw('set @row:=0'));
            $MPU_DEBIT = DB::connection('mysql2')->select("select  @row:=@row + 1 AS NO, 'Between  $startdate and $enddate' as Date,
            CARD_BRANCH_ID,CARD_CARDPLAN_ID,count(*) as Count
            from CZ_CARD 
           where CARD_CARDPLAN_ID like 'MPU_DEBIT'
           and CARD_ANNIVERSARY_DATE between $startdate and $enddate
           and CARD_APP_DATE is null
           group by CARD_BRANCH_ID");
            return $MPU_DEBIT;
        }
    }
    public static function MOB_UPI_DB(Request $req)
    {
        $validation=$req->validate([
            "startdate"=>"required",
            "enddate"=>"required",
            "brand"=>"required",
        ]);
        $startdate=substr($req->startdate, 0, 4).substr($req->startdate, 5, 2).substr($req->startdate, 8, 2);
        $enddate=substr($req->enddate, 0, 4).substr($req->enddate, 5, 2).substr($req->enddate, 8, 2);
        if ($validation) {
            DB::connection('mysql2')->statement(DB::raw('set @row:=0'));
            $MOB_UPI_DB = DB::connection('mysql2')->select("select  @row:=@row + 1 AS NO,'Between  $startdate and $enddate' as Date,
            CARD_BRANCH_ID,CARD_CARDPLAN_ID,count(*) as Count
            from CZ_CARD 
           where  CARD_CARDPLAN_ID like 'MOB_UPI_DB'
           and CARD_ANNIVERSARY_DATE between $startdate and $enddate
           group by CARD_BRANCH_ID");
            return $MOB_UPI_DB;
        }
    }
}