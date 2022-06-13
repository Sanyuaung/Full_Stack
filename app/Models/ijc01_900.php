<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ijc01_900 extends Model
{
    protected $guarded  =[];
    use HasFactory;
    public static function ijc01_900s()
    {
        DB::statement(DB::raw('set @row:=0'));
        $ijc01_900s=DB::select('select substring(Field1,1,3) as recordtype,substring(Field1,4,11) as member_institution,
        substring(Field1,15,1) as Outgoing_amt_sign,format(concat(substring(Field1,16,14),".",substring(Field1,30,2)),2) as Outgoing_amt,
        substring(Field1,32,1) as Outgoing_fee_sign,format(concat(substring(Field1,33,14),".",substring(Field1,47,2)),2) as outgoing_fee,
        substring(Field1,49,1) as incoming_amt_sign,format(concat(substring(Field1,50,14),".",substring(Field1,64,2)),2) as incoming_amt,
        substring(Field1,66,1) as incoming_fee_sign,format(concat(substring(Field1,67,14),".",substring(Field1,81,2)),2) as incoming_fee,
        substring(Field1,83,1) as STF_amt_sign,format(concat(substring(Field1,84,14),".",substring(Field1,98,2)),2) as STF_amt,
        substring(Field1,100,1) as STF_Fee_sign,format(concat(substring(Field1,101,14),".",substring(Field1,115,2)),2) as STF_fee,
        substring(Field1,117,10) as outgoing_summary,substring(Field1,127,10) as incoming_summary,
        substring(Field1,137,3) as settlement_curr,substring(Field1,140,30) as reserved,
        (@row:=@row + 1) AS NO,filename
        from ijc01_900s');
        return $ijc01_900s;
    }
}
