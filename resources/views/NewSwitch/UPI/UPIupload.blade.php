@extends('layouts/app')
@section('content')
    <link href="/css/mpu.css" rel="stylesheet">
    <a class="float-start mb-3" title="Back" href="{{ route('UPIHome') }}" role="button"><span class="iconify"
            data-icon="akar-icons:arrow-back-thick" style="color: #d80000;" data-width="25"></span></a>
    <a class="float-start ml-15 mb-3" href="{{ route('upidownload') }}" title="Download"
        onclick="return confirm('Are you sure you want to download?')" role="button">&nbsp;&nbsp;&nbsp;<span
            class="iconify" data-icon="ic:sharp-sim-card-download" style="color: #d80000;" data-width="25"></span></a>
    <span class="float-end mb-3">{{ $filename }}</span></span>
    <div class="mt-3 scroll-table-container">
        <table class="table-bordered border-white scroll-table">
            <thead>
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">Txn_code</th>
                    <th scope="col">bitmap</th>
                    <th scope="col">Cardno</th>
                    <th scope="col">Txn_Amount</th>
                    <th scope="col">Curr</th>
                    <th scope="col">Txn_datetime</th>
                    <th scope="col">trace_no</th>
                    <th scope="col">Auth_ID_resp</th>
                    <th scope="col">Date_Auth</th>
                    <th scope="col">RRN</th>
                    <th scope="col">Acq_ID</th>
                    <th scope="col">Forward_ID</th>
                    <th scope="col">merchant_type</th>
                    <th scope="col">Card_acceptor_id</th>
                    <th scope="col">Card_acceptorid_code</th>
                    <th scope="col">Card_acceptor_name</th>
                    <th scope="col">Origin_txn</th>
                    <th scope="col">msg_reason</th>
                    <th scope="col">single_dual</th>
                    <th scope="col">GSCS_serial</th>
                    <th scope="col">Receiving_ID</th>
                    <th scope="col">Issuing_ID</th>
                    <th scope="col">ID_GSCS</th>
                    <th scope="col">Txn_initial_channel</th>
                    <th scope="col">Txn_features</th>
                    <th scope="col">Txn_scenario</th>
                    <th scope="col">Reserved</th>
                    <th scope="col">other_info</th>
                    <th scope="col">POS_entry_mode</th>
                    <th scope="col">Floor_limit</th>
                    <th scope="col">Type_PaymentService</th>
                    <th scope="col">Settlement_Amt</th>
                    <th scope="col">settlement_curr</th>
                    <th scope="col">settlement_convert_rate</th>
                    <th scope="col">Cardholder_billamt</th>
                    <th scope="col">Cardholder_bill_curr</th>
                    <th scope="col">Cardholder_billing_convert_rate</th>
                    <th scope="col">Net_Fee_Amt</th>
                    <th scope="col">IRF_Curr</th>
                    <th scope="col">Exrate_RF_bill_to_settlement_curr</th>
                    <th scope="col">Abbrev_Foreign_institute</th>
                    <th scope="col">mainland_china_txn_ind</th>
                    <th scope="col">Txn_fee</th>
                    <th scope="col">QRC_voucher_no</th>
                    <th scope="col">Reserved1</th>
                    <th scope="col">Applied_cryptogram</th>
                    <th scope="col">POS_entry_mode1</th>
                    <th scope="col">Application_PAN_seq_num</th>
                    <th scope="col">Terminal_entry_capability</th>
                    <th scope="col">IC_card_condition_code</th>
                    <th scope="col">Terminal_capabilities</th>
                    <th scope="col">Terminal_verification_results</th>
                    <th scope="col">Unpredictable_number</th>
                    <th scope="col">Serial_number_of_interface_device</th>
                    <th scope="col">Issuing_bank_application_data</th>
                    <th scope="col">Application_transaction_counter</th>
                    <th scope="col">Application_alternation_characteristic</th>
                    <th scope="col">Transaction_date</th>
                    <th scope="col">Country_code_of_the_terminal</th>
                    <th scope="col">Script_result_of_the_card_Issuer</th>
                    <th scope="col">Authorization_response_code</th>
                    <th scope="col">Transaction_category</th>
                    <th scope="col">Authorized_amount</th>
                    <th scope="col">Currency_code_transaction</th>
                    <th scope="col">Cipher_text_information_data</th>
                    <th scope="col">Other_amount</th>
                    <th scope="col">Authentication_method_and_result_of_the_cardholder</th>
                    <th scope="col">Terminal_category</th>
                    <th scope="col">Dedicated_document_name</th>
                    <th scope="col">Application_version_number</th>
                    <th scope="col">Transaction_serial_counter</th>
                    <th scope="col">Reserved2</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($ifc99c as $ifc99c)
                    <tr>
                        <td>{{ $ifc99c->NO }}</td>
                        <td>{{ $ifc99c->Txn_code }}</td>
                        <td>{{ $ifc99c->bitmap }}</td>
                        <td>{{ $ifc99c->Cardno }}</td>
                        <td>{{ $ifc99c->Txn_Amount }}</td>
                        <td>{{ $ifc99c->Curr }}</td>
                        <td>{{ $ifc99c->Txn_datetime }}</td>
                        <td>{{ $ifc99c->trace_no }}</td>
                        <td>{{ $ifc99c->Auth_ID_resp }}</td>
                        <td>{{ $ifc99c->Date_Auth }}</td>
                        <td>{{ $ifc99c->RRN }}</td>
                        <td>{{ $ifc99c->Acq_ID }}</td>
                        <td>{{ $ifc99c->Forward_ID }}</td>
                        <td>{{ $ifc99c->merchant_type }}</td>
                        <td>{{ $ifc99c->Card_acceptor_id }}</td>
                        <td>{{ $ifc99c->Card_acceptorid_code }}</td>
                        <td>{{ $ifc99c->Card_acceptor_name }}</td>
                        <td>{{ $ifc99c->Origin_txn }}</td>
                        <td>{{ $ifc99c->msg_reason }}</td>
                        <td>{{ $ifc99c->single_dual }}</td>
                        <td>{{ $ifc99c->GSCS_serial }}</td>
                        <td>{{ $ifc99c->Receiving_ID }}</td>
                        <td>{{ $ifc99c->Issuing_ID }}</td>
                        <td>{{ $ifc99c->ID_GSCS }}</td>
                        <td>{{ $ifc99c->Txn_initial_channel }}</td>
                        <td>{{ $ifc99c->Txn_features }}</td>
                        <td>{{ $ifc99c->Txn_scenario }}</td>
                        <td>{{ $ifc99c->Reserved }}</td>
                        <td>{{ $ifc99c->other_info }}</td>
                        <td>{{ $ifc99c->POS_entry_mode }}</td>
                        <td>{{ $ifc99c->Floor_limit }}</td>
                        <td>{{ $ifc99c->Type_PaymentService }}</td>
                        <td>{{ $ifc99c->Settlement_Amt }}</td>
                        <td>{{ $ifc99c->settlement_curr }}</td>
                        <td>{{ $ifc99c->settlement_convert_rate }}</td>
                        <td>{{ $ifc99c->Cardholder_billamt }}</td>
                        <td>{{ $ifc99c->Cardholder_bill_curr }}</td>
                        <td>{{ $ifc99c->Cardholder_billing_convert_rate }}</td>
                        <td>{{ $ifc99c->Net_Fee_Amt }}</td>
                        <td>{{ $ifc99c->IRF_Curr }}</td>
                        <td>{{ $ifc99c->Exrate_RF_bill_to_settlement_curr }}</td>
                        <td>{{ $ifc99c->Abbrev_Foreign_institute }}</td>
                        <td>{{ $ifc99c->mainland_china_txn_ind }}</td>
                        <td>{{ $ifc99c->Txn_fee }}</td>
                        <td>{{ $ifc99c->QRC_voucher_no }}</td>
                        <td>{{ $ifc99c->Reserved1 }}</td>
                        <td>{{ $ifc99c->Applied_cryptogram }}</td>
                        <td>{{ $ifc99c->POS_entry_mode1 }}</td>
                        <td>{{ $ifc99c->Application_PAN_seq_num }}</td>
                        <td>{{ $ifc99c->Terminal_entry_capability }}</td>
                        <td>{{ $ifc99c->IC_card_condition_code }}</td>
                        <td>{{ $ifc99c->Terminal_capabilities }}</td>
                        <td>{{ $ifc99c->Terminal_verification_results }}</td>
                        <td>{{ $ifc99c->Unpredictable_number }}</td>
                        <td>{{ $ifc99c->Serial_number_of_interface_device }}</td>
                        <td>{{ $ifc99c->Issuing_bank_application_data }}</td>
                        <td>{{ $ifc99c->Application_transaction_counter }}</td>
                        <td>{{ $ifc99c->Application_alternation_characteristic }}</td>
                        <td>{{ $ifc99c->Transaction_date }}</td>
                        <td>{{ $ifc99c->Country_code_of_the_terminal }}</td>
                        <td>{{ $ifc99c->Script_result_of_the_card_Issuer }}</td>
                        <td>{{ $ifc99c->Authorization_response_code }}</td>
                        <td>{{ $ifc99c->Transaction_category }}</td>
                        <td>{{ $ifc99c->Authorized_amount }}</td>
                        <td>{{ $ifc99c->Currency_code_transaction }}</td>
                        <td>{{ $ifc99c->Cipher_text_information_data }}</td>
                        <td>{{ $ifc99c->Other_amount }}</td>
                        <td>{{ $ifc99c->Authentication_method_and_result_of_the_cardholder }}</td>
                        <td>{{ $ifc99c->Terminal_category }}</td>
                        <td>{{ $ifc99c->Dedicated_document_name }}</td>
                        <td>{{ $ifc99c->Application_version_number }}</td>
                        <td>{{ $ifc99c->Transaction_serial_counter }}</td>
                        <td>{{ $ifc99c->Reserved2 }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
