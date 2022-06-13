<?php

namespace App\Exports;

use App\Models\ifc99c;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ifc99cExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function headings(): array
    {
        return [
            'Txn_code',
            'bitmap',
            'Cardno',
            'Txn_Amount',
            'Curr',
            'Txn_datetime',
            'trace_no',
            'Auth_ID_resp',
            'Date_Auth',
            'RRN',
            'Acq_ID',
            'Forward_ID',
            'merchant_type',
            'Card_acceptor_id',
            'Card_acceptorid_code',
            'Card_acceptor_name',
            'Origin_txn',
            'msg_reason',
            'single_dual',
            'GSCS_serial',
            'Receiving_ID',
            'Issuing_ID',
            'ID_GSCS',
            'Txn_initial_channel',
            'Txn_features',
            'Txn_scenario',
            'Reserved',
            'other_info',
            'POS_entry_mode',
            'Floor_limit',
            'Type_PaymentService',
            'Settlement_Amt',
            'settlement_curr',
            'settlement_convert_rate',
            'Cardholder_billamt',
            'Cardholder_bill_curr',
            'Cardholder_billing_convert_rate',
            'Net_Fee_Amt',
            'IRF_Curr',
            'Exrate_RF_bill_to_settlement_curr',
            'Abbrev_Foreign_institute',
            'mainland_china_txn_ind',
            'Txn_fee',
            'QRC_voucher_no',
        ];
    }
    public function map($ifc99c): array
    {
        return [
            $ifc99c->Txn_code,
            $ifc99c->bitmap,
            "'" . $ifc99c->Cardno,
            $ifc99c->Txn_Amount,
            "'" . $ifc99c->Curr,
            $ifc99c->Txn_datetime,
            $ifc99c->trace_no,
            $ifc99c->Auth_ID_resp,
            $ifc99c->Date_Auth,
            "'" . $ifc99c->RRN,
            $ifc99c->Acq_ID,
            $ifc99c->Forward_ID,
            $ifc99c->merchant_type,
            $ifc99c->Card_acceptor_id,
            "'" . $ifc99c->Card_acceptorid_code,
            "'" . $ifc99c->Card_acceptor_name,
            $ifc99c->Origin_txn,
            $ifc99c->msg_reason,
            $ifc99c->single_dual,
            $ifc99c->GSCS_serial,
            $ifc99c->Receiving_ID,
            $ifc99c->Issuing_ID,
            $ifc99c->ID_GSCS,
            $ifc99c->Txn_initial_channel,
            $ifc99c->Txn_features,
            $ifc99c->Txn_scenario,
            $ifc99c->Reserved,
            $ifc99c->other_info,
            $ifc99c->POS_entry_mode,
            $ifc99c->Floor_limit,
            $ifc99c->Type_PaymentService,
            $ifc99c->Settlement_Amt,
            $ifc99c->settlement_curr,
            $ifc99c->settlement_convert_rate,
            "'" . $ifc99c->Cardholder_billamt,
            $ifc99c->Cardholder_bill_curr,
            $ifc99c->Cardholder_billing_convert_rate,
            $ifc99c->Net_Fee_Amt,
            $ifc99c->IRF_Curr,
            $ifc99c->Exrate_RF_bill_to_settlement_curr,
            $ifc99c->Abbrev_Foreign_institute,
            $ifc99c->mainland_china_txn_ind,
            $ifc99c->Txn_fee,
            $ifc99c->QRC_voucher_no,
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return collect(ifc99c::ifc99c());
    }
}
