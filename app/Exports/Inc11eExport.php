<?php

namespace App\Exports;

use App\Models\inc11e;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class Inc11eExport implements FromCollection, WithHeadings, WithMapping,ShouldAutoSize
{
    public function headings(): array
    {
        return[
            'recordtype',
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
            'Date_of_Authorization',
            'RRN',
            'Acquiring_IIN',
            'Forwarding_IIC',
            'Merchant_Type',
            'Card_Acceptor_Terminal_Identification',
            'Card_Acceptor_Identification_Code',
            'Card_Acceptor_Name',
            'Original_Transaction_Information',
            'Message_Reason_Code',
            'Receivig_IIC',
            'Issuing_IIC',
            'Identifier_of_Transaction_Features',
            'Point_of_Service_Condition_Code',
            'Merchant_Currency',
            'Authorization_Type',
            'Service_Fee_Receivable',
            'Service_Fee_Payable',
            'Reserved',
        ];
    }

    public function map($inc11e): array
    {
        return [
              $inc11e->recordtype,
              "'".$inc11e->PAN,
              $inc11e->Processing_Code,
              $inc11e->Amount_Transaction,
              $inc11e->Amount_Settlement,
              $inc11e->Sett_Conversion_Rate,
              $inc11e->Currency_Code_Transaction,
              $inc11e->Settlement_Currency_Code,
              $inc11e->Transmission_Date_and_Time,
              $inc11e->System_Trace_Audit_Number,
              $inc11e->Authorization_Identification_Response,
              $inc11e->Date_of_Authorization,
              $inc11e->RRN,
              $inc11e->Acquiring_IIN,
              $inc11e->Forwarding_IIC,
              $inc11e->Merchant_Type,
              $inc11e->Card_Acceptor_Terminal_Identification,
              "'".$inc11e->Card_Acceptor_Identification_Code,
              $inc11e->Card_Acceptor_Name,
              $inc11e->Original_Transaction_Information,
              $inc11e->Message_Reason_Code,
              $inc11e->Receivig_IIC,
              $inc11e->Issuing_IIC,
              $inc11e->Identifier_of_Transaction_Features,
              $inc11e->Point_of_Service_Condition_Code,
              $inc11e->Merchant_Currency,
              $inc11e->Authorization_Type,
              $inc11e->Service_Fee_Receivable,
              $inc11e->Service_Fee_Payable,
              $inc11e->Reserved,
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(inc11e::inc11e());
        ;
    }
}