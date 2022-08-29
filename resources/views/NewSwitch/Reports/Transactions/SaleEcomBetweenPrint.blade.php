@extends('layouts/app')
@section('content')
    <link href="/css/co.css" rel="stylesheet">
    <a class="float-start mb-3" href="{{ route('SaleEcomHome') }}" role="button"><span class="iconify"
            data-icon="akar-icons:arrow-back-thick" style="color: #d80000;" data-width="25"></span></a>
    <a class="float-start ml-15 mb-3"
        href="{{ route('SaleEcomBetweenExport', [
            'type' => $type,
            'start' => $start,
            'end' => $end,
            'sign' => $sign,
            'reqamt1' => $reqamt1,
            'reqamt2' => $reqamt2,
        ]) }}"
        onclick="return confirm('Are you sure you want to download?')" role="button">&nbsp;&nbsp;&nbsp;<span
            class="iconify" data-icon="ic:sharp-sim-card-download" style="color: #d80000;" data-width="25"></span></a>
    <span class="float-end mb-3">{{ $type }} Trans from {{ $start }} to {{ $end }}</span>
    <div class="scroll-table-container">
        <table class="table-bordered border-white scroll-table">
            <thead>
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">AUTHTXN_CUST_ID</th>
                    <th scope="col">AUTHTXN_CARDHOLDER_NAME</th>
                    <th scope="col">AUTHTXN_CRDACCT_NO</th>
                    <th scope="col">AUTHTXN_REQUEST_AMT</th>
                    <th scope="col">Tran_Count</th>
                    <th scope="col">Total</th>
                    <th scope="col">AUTHTXN_MERCHANT_NAME</th>
                    <th scope="col">AUTHTXN_TXNTYPE_ID</th>
                    <th scope="col">AUTHTXN_CRDPLAN_ID</th>
                    <th scope="col">AUTHTXN_REQUEST_DATE</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($trans as $trans)
                    <tr>
                        <td>{{ $trans->NO }}</td>
                        <td>{{ $trans->AUTHTXN_CUST_ID }}</td>
                        <td>{{ $trans->AUTHTXN_CARDHOLDER_NAME }}</td>
                        <td>{{ $trans->AUTHTXN_CRDACCT_NO }}</td>
                        <td>{{ $trans->AUTHTXN_REQUEST_AMT }}</td>
                        <td>{{ $trans->Tran_Count }}</td>
                        <td>{{ $trans->Total }}</td>
                        <td>{{ $trans->AUTHTXN_MERCHANT_NAME }}</td>
                        <td>{{ $trans->AUTHTXN_TXNTYPE_ID }}</td>
                        <td>{{ $trans->AUTHTXN_CRDPLAN_ID }}</td>
                        <td>{{ $trans->AUTHTXN_REQUEST_DATE }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
