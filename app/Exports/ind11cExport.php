<?php

namespace App\Exports;

use App\Models\ind11c;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ind11cExport implements FromCollection, WithHeadings, WithMapping,ShouldAutoSize
{
    public function headings(): array
    {
        return[
            'Record_Type',
            'PAN',
            'Processing_Code',
            'Amount_Transaction',
            'Amount_Settlement',
            'Sett_Conversion_Rate',
            'Currency_Code_Transaction',
            'Settlement_Currency_Code',
            'Transmission_Date_and_Time',
            'System_Trace_Audit_Number',
            'Authorization_Identification_Response',
            'Date_Authorization',
            'RRN',
            'Acquring_IIN',
            'Forwarding_IIN',
            'Merchant_Type',
            'Card_Acceptor_Terminal_Identification',
            'Card_Acceptor_Identification',
            'Card_Acceptor_Name',
            'Original_Transaction_Information',
            'Message_Reason_Code',
            'Receiving_IIN',
            'Issuing_IIN',
            'Identifer_of_Transaction_Feature',
            'Point_of_Service_Condition_Code',
            'Merchant_Country_Code',
            'Authorization_Type',
            'Service_Fee_Receivable',
            'Service_Fee_Payable',
            'Reserved',
        ];
    }
    public function map($ind11c): array
    {
        return [

              $ind11c->Record_Type,
              "'".$ind11c->PAN,
              $ind11c->Processing_Code,
              $ind11c->Amount_Transaction,
              $ind11c->Amount_Settlement,
              $ind11c->Sett_Conversion_Rate,
              $ind11c->Currency_Code_Transaction,
              $ind11c->Settlement_Currency_Code,
              $ind11c->Transmission_Date_and_Time,
              $ind11c->System_Trace_Audit_Number,
              $ind11c->Authorization_Identification_Response,
              $ind11c->Date_Authorization,
              "'".$ind11c->RRN,
              $ind11c->Acquring_IIN,
              $ind11c->Forwarding_IIN,
              $ind11c->Merchant_Type,
              $ind11c->Card_Acceptor_Terminal_Identification,
              "'".$ind11c->Card_Acceptor_Identification,
              $ind11c->Card_Acceptor_Name,
              $ind11c->Original_Transaction_Information,
              $ind11c->Message_Reason_Code,
              $ind11c->Receiving_IIN,
              $ind11c->Issuing_IIN,
              $ind11c->Identifer_of_Transaction_Feature,
              $ind11c->Point_of_Service_Condition_Code,
              $ind11c->Merchant_Country_Code,
              $ind11c->Authorization_Type,
              $ind11c->Service_Fee_Receivable,
              $ind11c->Service_Fee_Payable,
              $ind11c->Reserved,
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(ind11c::ind11c());
    }
}