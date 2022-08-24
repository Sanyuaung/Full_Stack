@extends('layouts/app')
@section('content')
    <link href="/css/co.css" rel="stylesheet">
    <a title="Back" class="float-start mb-3" href="{{ route('AnnualFeeListingHome') }}" role="button"><span class="iconify"
            data-icon="akar-icons:arrow-back-thick" style="color: #d80000;" data-width="25"></span></a>
    <a title="Download" class="float-start ml-15 mb-3"
        href="{{ route('AnnualFeeListingDownload', ['month' => $month, 'card' => $card]) }}"
        onclick="return confirm('Are you sure you want to download?')" role="button">&nbsp;&nbsp;&nbsp;<span
            class="iconify" data-icon="ic:sharp-sim-card-download" style="color: #d80000;" data-width="25"></span></a>
    <span class="float-end mb-3">AnnualFee Listing of {{ $card }} in {{ $month }} Month</span>
    <div class="mt-3 scroll-table-container">
        <table class="table-bordered border-white scroll-table">
            <thead>
                <tr>
                    <th scope="col">CARD_CUST_ID</th>
                    <th scope="col">CARD_EMBOSSED_NAME</th>
                    <th scope="col">CARD_CRDACCT_NO</th>
                    <th scope="col">CARD_CARDPLAN_ID</th>
                    <th scope="col">CARD_PLAN</th>
                    <th scope="col">CARD_BS_IND</th>
                    <th scope="col">CARD_PLASTIC_CODE</th>
                    <th scope="col">CUST_STATUS_ID</th>
                    <th scope="col">CRDACCT_STATUS_ID</th>
                    <th scope="col">CARD_APP_DATE</th>
                    <th scope="col">Last_Annual</th>
                    <th scope="col">CONTACT_STAFF</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <td>{{ $data->CARD_CUST_ID }}</td>
                        <td>{{ $data->CARD_EMBOSSED_NAME }}</td>
                        <td>{{ $data->CARD_CRDACCT_NO }}</td>
                        <td>{{ $data->CARD_CARDPLAN_ID }}</td>
                        <td>{{ $data->CARD_PLAN }}</td>
                        <td>{{ $data->CARD_BS_IND }}</td>
                        <td>{{ $data->CARD_PLASTIC_CODE }}</td>
                        <td>{{ $data->CUST_STATUS_ID }}</td>
                        <td>{{ $data->CRDACCT_STATUS_ID }}</td>
                        <td>{{ $data->CARD_APP_DATE }}</td>
                        <td>{{ $data->Last_Annual }}</td>
                        <td>{{ $data->CONTACT_STAFF }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
