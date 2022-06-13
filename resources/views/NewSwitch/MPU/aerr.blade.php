@extends('layouts/app')
@section('content')
    <link href="/css/mpu.css" rel="stylesheet">
    <a class="float-start mb-3" title="Back" href="{{ route('MPUHome') }}" role="button"><span class="iconify"
            data-icon="akar-icons:arrow-back-thick" style="color: #d80000;" data-width="25"></span></a>
    <a class="float-start ml-15 mb-3" href="{{ route('downloadAerr') }}" title="Download"
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
                @foreach ($aerr as $aerr)
                    <tr>
                        <td>{{ $aerr->NO }}</td>
                        <td>{{ $aerr->recordtype }}</td>
                        <td>{{ $aerr->CardNo }}</td>
                        <td>{{ $aerr->process_code }}</td>
                        <td>{{ $aerr->txn_amt }}</td>
                        <td>{{ $aerr->settle_amt }}</td>
                        <td>{{ $aerr->sett_rate }}</td>
                        <td>{{ $aerr->system_trace }}</td>
                        <td>{{ $aerr->txn_time }}</td>
                        <td>{{ $aerr->txn_date }}</td>
                        <td>{{ $aerr->settle_date }}</td>
                        <td>{{ $aerr->MCC }}</td>
                        <td>{{ $aerr->Acq_institution_code }}</td>
                        <td>{{ $aerr->Issuer_bank_code }}</td>
                        <td>{{ $aerr->beneficiary_bank_code }}</td>
                        <td>{{ $aerr->Forward_institution_code }}</td>
                        <td>{{ $aerr->auth_no }}</td>
                        <td>{{ $aerr->RRN }}</td>
                        <td>{{ $aerr->Card_Acceptor_Terminal }}</td>
                        <td>{{ $aerr->txn_curr_code }}</td>
                        <td>{{ $aerr->settle_curr_code }}</td>
                        <td>{{ $aerr->from_acc }}</td>
                        <td>{{ $aerr->to_acc }}</td>
                        <td>{{ $aerr->msg_type_identifier }}</td>
                        <td>{{ $aerr->reason_code }}</td>
                        <td>{{ $aerr->receivable_fee }}</td>
                        <td>{{ $aerr->payable_fee }}</td>
                        <td>{{ $aerr->interchange_fee }}</td>
                        <td>{{ $aerr->POS_mode }}</td>
                        <td>{{ $aerr->system_traceno }}</td>
                        <td>{{ $aerr->POS_condition }}</td>
                        <td>{{ $aerr->card_acceptor_code }}</td>
                        <td>{{ $aerr->accept_amt }}</td>
                        <td>{{ $aerr->cardholder_fee }}</td>
                        <td>{{ $aerr->txn_tramsmission }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
