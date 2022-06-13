@extends('layouts/app')
@section('content')
    <link href="/css/mpu.css" rel="stylesheet">
    <a class="float-start mb-3" title="Back" href="{{ route('MPUHome') }}" role="button"><span class="iconify"
            data-icon="akar-icons:arrow-back-thick" style="color: #d80000;" data-width="25"></span></a>
    <a class="float-start ml-15 mb-3" href="{{ route('downloadACOM') }}" title="Download"
        onclick="return confirm('Are you sure you want to download?')" role="button">&nbsp;&nbsp;&nbsp;<span
            class="iconify" data-icon="ic:sharp-sim-card-download" style="color: #d80000;" data-width="25"></span></a>
    <span class="float-end mb-3 text-danger">{{ $filename }}</span></span>
    <div class="mt-3 scroll-table-container">
        <table class="table-bordered border-white scroll-table">
            <thead>
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">Record_Type</th>
                    <th scope="col">CardNo</th>
                    <th scope="col">Processing_Code</th>
                    <th scope="col">txn_amt</th>
                    <th scope="col">settle_amt</th>
                    <th scope="col">sett_rate</th>
                    <th scope="col">system_trace</th>
                    <th scope="col">txn_time</th>
                    <th scope="col">txn_date</th>
                    <th scope="col">settle_date</th>
                    <th scope="col">MCC</th>
                    <th scope="col">Acq_institution_code</th>
                    <th scope="col">Issuer_bank_code</th>
                    <th scope="col">beneficiary_bank_code</th>
                    <th scope="col">Forward_institution_code</th>
                    <th scope="col">auth_no</th>
                    <th scope="col">RRN</th>
                    <th scope="col">Card_Acceptor_Terminal</th>
                    <th scope="col">txn_curr_code</th>
                    <th scope="col">settle_curr_code</th>
                    <th scope="col">from_acc</th>
                    <th scope="col">to_acc</th>
                    <th scope="col">msg_type_identifier</th>
                    <th scope="col">res_code</th>
                    <th scope="col">receivable_fee</th>
                    <th scope="col">payable_fee</th>
                    <th scope="col">interchange_fee</th>
                    <th scope="col">POS_mode</th>
                    <th scope="col">system_traceno</th>
                    <th scope="col">POS_condition</th>
                    <th scope="col">card_acceptor_code</th>
                    <th scope="col">accept_amt</th>
                    <th scope="col">cardholder_fee</th>
                    <th scope="col">txn_tramsmission</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($acom as $acom)
                    <tr>
                        <td>{{ $acom->NO }}</td>
                        <td>{{ $acom->recordtype }}</td>
                        <td>{{ $acom->CardNo }}</td>
                        <td>{{ $acom->process_code }}</td>
                        <td>{{ $acom->txn_amt }}</td>
                        <td>{{ $acom->settle_amt }}</td>
                        <td>{{ $acom->sett_rate }}</td>
                        <td>{{ $acom->system_trace }}</td>
                        <td>{{ $acom->txn_time }}</td>
                        <td>{{ $acom->txn_date }}</td>
                        <td>{{ $acom->settle_date }}</td>
                        <td>{{ $acom->MCC }}</td>
                        <td>{{ $acom->Acq_institution_code }}</td>
                        <td>{{ $acom->Issuer_bank_code }}</td>
                        <td>{{ $acom->beneficiary_bank_code }}</td>
                        <td>{{ $acom->Forward_institution_code }}</td>
                        <td>{{ $acom->auth_no }}</td>
                        <td>{{ $acom->RRN }}</td>
                        <td>{{ $acom->Card_Acceptor_Terminal }}</td>
                        <td>{{ $acom->txn_curr_code }}</td>
                        <td>{{ $acom->settle_curr_code }}</td>
                        <td>{{ $acom->from_acc }}</td>
                        <td>{{ $acom->to_acc }}</td>
                        <td>{{ $acom->msg_type_identifier }}</td>
                        <td>{{ $acom->res_code }}</td>
                        <td>{{ $acom->receivable_fee }}</td>
                        <td>{{ $acom->payable_fee }}</td>
                        <td>{{ $acom->interchange_fee }}</td>
                        <td>{{ $acom->POS_mode }}</td>
                        <td>{{ $acom->system_traceno }}</td>
                        <td>{{ $acom->POS_condition }}</td>
                        <td>{{ $acom->card_acceptor_code }}</td>
                        <td>{{ $acom->accept_amt }}</td>
                        <td>{{ $acom->cardholder_fee }}</td>
                        <td>{{ $acom->txn_tramsmission }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
