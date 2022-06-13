<?php

namespace App\Exports;

use App\Models\inc01c;
use App\Models\ind01c;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class inc01cExport implements FromCollection, WithHeadings, WithMapping,ShouldAutoSize
{
    protected $name;
    function __construct($name)
    {
        $this->name=$name;
    }
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
    public function map($ind01c): array
    {
        return [

              $ind01c->Record_Type,
              "'".$ind01c->PAN,
              $ind01c->Processing_Code,
              $ind01c->Amount_Transaction,
              $ind01c->Amount_Settlement,
              $ind01c->Sett_Conversion_Rate,
              $ind01c->Currency_Code_Transaction,
              $ind01c->Settlement_Currency_Code,
              $ind01c->Transmission_Date_and_Time,
              $ind01c->System_Trace_Audit_Number,
              $ind01c->Authorization_Identification_Response,
              $ind01c->Date_Authorization,
              "'".$ind01c->RRN,
              $ind01c->Acquring_IIN,
              $ind01c->Forwarding_IIN,
              $ind01c->Merchant_Type,
              $ind01c->Card_Acceptor_Terminal_Identification,
              "'".$ind01c->Card_Acceptor_Identification,
              $ind01c->Card_Acceptor_Name,
              $ind01c->Original_Transaction_Information,
              $ind01c->Message_Reason_Code,
              $ind01c->Receiving_IIN,
              $ind01c->Issuing_IIN,
              $ind01c->Identifer_of_Transaction_Feature,
              $ind01c->Point_of_Service_Condition_Code,
              $ind01c->Merchant_Country_Code,
              $ind01c->Authorization_Type,
              $ind01c->Service_Fee_Receivable,
              $ind01c->Service_Fee_Payable,
              $ind01c->Reserved,
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if ($this->name==='INC01C'||$this->name==='INC01X') {
            return collect(inc01c::inc01c());
        }elseif($this->name==='IUC01C'||$this->name==='IUC01X'){
            return collect(inc01c::iuc01c());
        }
    }
}