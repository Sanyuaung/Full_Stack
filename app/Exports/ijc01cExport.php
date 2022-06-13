<?php

namespace App\Exports;

use App\Models\ijc01c;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ijc01cExport implements FromCollection,WithHeadings,WithMapping,ShouldAutoSize
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
    public function map($ijc01c): array
    {
        return [

              $ijc01c->Record_Type,
              "'".$ijc01c->PAN,
              $ijc01c->Processing_Code,
              $ijc01c->Amount_Transaction,
              $ijc01c->Amount_Settlement,
              $ijc01c->Sett_Conversion_Rate,
              $ijc01c->Currency_Code_Transaction,
              $ijc01c->Settlement_Currency_Code,
              $ijc01c->Transmission_Date_and_Time,
              $ijc01c->System_Trace_Audit_Number,
              $ijc01c->Authorization_Identification_Response,
              $ijc01c->Date_Authorization,
              "'".$ijc01c->RRN,
              $ijc01c->Acquring_IIN,
              $ijc01c->Forwarding_IIN,
              $ijc01c->Merchant_Type,
              $ijc01c->Card_Acceptor_Terminal_Identification,
              "'".$ijc01c->Card_Acceptor_Identification,
              $ijc01c->Card_Acceptor_Name,
              $ijc01c->Original_Transaction_Information,
              $ijc01c->Message_Reason_Code,
              $ijc01c->Receiving_IIN,
              $ijc01c->Issuing_IIN,
              $ijc01c->Identifer_of_Transaction_Feature,
              $ijc01c->Point_of_Service_Condition_Code,
              $ijc01c->Merchant_Country_Code,
              $ijc01c->Authorization_Type,
              $ijc01c->Service_Fee_Receivable,
              $ijc01c->Service_Fee_Payable,
              $ijc01c->Reserved,
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(ijc01c::ijc01c());
    }
}