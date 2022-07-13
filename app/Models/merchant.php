<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class merchant extends Model
{
    use HasFactory;
    protected $fillable = [
        'MERCHANT_ID',
        'MERCHANT_TRADE_NAME'
    ];
}