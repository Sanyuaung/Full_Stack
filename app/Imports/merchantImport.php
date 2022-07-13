<?php

namespace App\Imports;

use App\Models\merchant;
use Maatwebsite\Excel\Concerns\ToModel;

class merchantImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $data = [

            'MERCHANT_ID' => $row[0],

            'MERCHANT_TRADE_NAME' => $row[1],
        ];

        merchant::create($data);
    }
}