<?php

namespace App\Http\Controllers;

use App\Models\jcb;
use Illuminate\Support\Facades\App;

class PdfController extends Controller
{
    public function get_customer_data()
    {
        $data=new jcb();
        $customer_data=[
            'users' => $data->show(),
            'one'   => $data->total1(),
            'two'   => $data->total2(),
            'three'   => $data->total3(),
            'four'   => $data->total4()
        ];
        return $customer_data;
    }
    public function pdf()
    {
        $pdf=App::make('dompdf.wrapper');
        $pdf->loadHtml($this->convert_pdf())->setPaper('a4', 'landscape');
        $d=new jcb;
        $date=$d->show();
        foreach ($date as $date) {
            $filename = "JCB".$date->date.'.pdf';
        }
        return $pdf->download($filename);
    }
    public function convert_pdf()
    {
        $customer_data=$this->get_customer_data();
        $header ='

            <h3 align="center">JCB Settlement</h3>


        <table width="100% style="boder-collapse:collapse; border:0px;">
            <thead>
              <tr>
                <th style="border: 1px solid; padding:12px;"align="center">NO</th>
                <th style="border: 1px solid; padding:12px;"align="center">Institution Code</th>
                <th style="border: 1px solid; padding:12px;"align="center">Acquiriing Bank Name</th>
                <th style="border: 1px solid; padding:12px;"align="center">Account Number</th>
                <th style="border: 1px solid; padding:12px;"align="center">Settlement Date</th>
                <th style="border: 1px solid; padding:12px;"align="center">MPU Commission</th>
                <th style="border: 1px solid; padding:12px;"align="center">Acquiriing Settlement Amount</th>
                <th style="border: 1px solid; padding:12px;"align="center">Debit</th>
                <th style="border: 1px solid; padding:12px;"align="center">Credit</th>
              </tr>
            </thead>
               ';
        foreach ($customer_data['users'] as $user) {
            $header.='
                <tbody>
                    <tr>
                        <td style="border: 1px solid;"align="center">'.$user->NO.'</td>
                        <td style="border: 1px solid;"align="center"><b>'.$user->Institution_Code.'</td>
                        <td style="border: 1px solid;"align="center"><b>'.$user->Short_Name.'</td>
                        <td style="border: 1px solid;"align="center"><b>'.$user->Account_Number.'</td>
                        <td style="border: 1px solid;"align="center"><b>'.$user->date.'</td>
                        <td style="border: 1px solid;"align="center"><b>'.$user->MPU_Comm.'</td>
                        <td style="border: 1px solid;"align="center"><b>'.$user->Acq_Bank_Settle_Amt.'</td>
                        <td style="border: 1px solid;"align="center"><b>'.$user->Debit.'</td>
                        <td style="border: 1px solid;"align="center"><b>'.$user->Credit.'</td>
                    </tr>
                </tbody>';
        }

        $output='
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                    <th style="border: 1px solid; padding:12px;"align="center">Total</th>
                ';
        foreach ($customer_data['one'] as $one) {
            $output.='
                    <th style="border: 1px solid; padding:12px; "align="center"><b>'.$one->one.'</th>
                ';
        }
        foreach ($customer_data['two'] as $two) {
            $output.='
                        <th style="border: 1px solid; padding:12px; "align="center"><b>'.$two->two.'</th>
                    ';
        }
        foreach ($customer_data['three'] as $three) {
            $output.='
                        <th style="border: 1px solid; padding:12px; "align="center"><b>'.$three->three.'</th>
                    ';
        }
        foreach ($customer_data['four'] as $four) {
            $output.='
                        <th style="border: 1px solid; padding:12px; "align="center"><b>'.$four->four.'</th>
                    ';
        }

        $output .= '</table>';
        return $header.$output;
    }
}