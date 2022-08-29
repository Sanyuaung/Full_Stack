@extends('layouts/app')
@section('content')
    <link href="/css/creditstatus.css" rel="stylesheet">
    <a class="float-start mb-3" href="{{ route('credithome') }}" role="button"><span class="iconify"
            data-icon="akar-icons:arrow-back-thick" style="color: #d80000;" data-width="25"></span></a>
    <a class="float-start ml-15 mb-3" href="{{ route('creditdownload', ['date' => $date]) }}"
        onclick="return confirm('Are you sure you want to download?')" role="button">&nbsp;&nbsp;&nbsp;<span
            class="iconify" data-icon="ic:sharp-sim-card-download" style="color: #d80000;" data-width="25"></span></a>
    <span class="float-end mb-3">Report Date : {{ $date }}</span>
    <div class="mt-3 scroll-table-container">
        <table class="table-bordered border-white scroll-table">
            <thead>
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">CARD_CUST_ID</th>
                    <th scope="col">CARD_EMBOSSED_NAME</th>
                    <th scope="col">CARD_BS_IND</th>
                    <th scope="col">ACCGRPLMT_CREDIT_LMT</th>
                    <th scope="col">CLOSE_BALANCE</th>
                    <th scope="col">CSTMTACCT_CURR_AGE_CODE</th>
                    <th scope="col">CARD_CARDPLAN_ID</th>
                    <th scope="col">CARD_PLASTIC_CODE</th>
                    <th scope="col">CSTMTACCT_YYYYMM</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cr as $cr)
                    <tr>
                        <td>{{ $cr->NO }}</td>
                        <td>{{ $cr->CARD_CUST_ID }}</td>
                        <td>{{ $cr->CARD_EMBOSSED_NAME }}</td>
                        <td>{{ $cr->CARD_BS_IND }}</td>
                        <td>{{ $cr->ACCGRPLMT_CREDIT_LMT }}</td>
                        <td>{{ $cr->CLOSE_BALANCE }}</td>
                        <td>{{ $cr->CSTMTACCT_CURR_AGE_CODE }}</td>
                        <td>{{ $cr->CARD_CARDPLAN_ID }}</td>
                        <td>{{ $cr->CARD_PLASTIC_CODE }}</td>
                        <td>{{ $cr->CSTMTACCT_YYYYMM }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
