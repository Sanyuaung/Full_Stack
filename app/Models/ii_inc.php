<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ii_inc extends Model
{
    protected $guarded  =[];
    use HasFactory;
    public static function inc11s_901()
    {
        DB::statement(DB::raw('set @row:=0'));
        $inc11s_901=DB::select('select substring(Field1,1,3) as recordtype,substring(Field1,4,11) as member_institution,substring(Field1,15,3) as curr_code,
        substring(Field1,18,3) as statistics_txn_code,substring(Field1,21,10) as no_txn_summary,
        format(concat(substring(Field1,31,14),".",substring(Field1,45,2)),2) as credit_amt,
        format(concat(substring(Field1,47,14),".",substring(Field1,61,2)),2) as debit_amt,
        substring(Field1,63,30) as reserved,
        (@row:=@row + 1) AS NO,filename
        from ii_incs');
        return $inc11s_901;
    }
}
