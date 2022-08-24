@extends('layouts/app')
@section('content')
    <link href="/css/co.css" rel="stylesheet">
    <a class="float-start mb-3" href="{{ route('annualfeehome') }}" role="button"><span class="iconify"
            data-icon="akar-icons:arrow-back-thick" style="color: #d80000;" data-width="25"></span></a>
    <a class="float-start ml-15 mb-3" href="{{ route('AnnualFeedownload', ['month1' => $month1, 'date2' => $date2, 'date1' => $date1]) }}"
        onclick="return confirm('Are you sure you want to download?')" role="button">&nbsp;&nbsp;&nbsp;<span
            class="iconify" data-icon="ic:sharp-sim-card-download" style="color: #d80000;" data-width="25"></span></a>
    <span class="float-end mb-3">Report Date :
        {{ $date1 }}</span>
    <div class="mt-3 scroll-table-container">
        <table class="table-bordered border-white scroll-table">
            <thead>
                <tr>
                    <th scope="col">CARD_CUST_ID</th>
                    <th scope="col">CARD_EMBOSSED_NAME</th>
                    <th scope="col">CARD_TYPE</th>
                    <th scope="col">CARD_CRDACCT_NO</th>
                    <th scope="col">CARD_BS_IND</th>
                    <th scope="col">CARD_PLASTIC_CODE</th>
                    <th scope="col">CRDACCT_STATUS_ID</th>
                    <th scope="col">CRDACCT_AGE_CODE</th>
                    <th scope="col">CARD_PLASTIC_DATE</th>
                    <th scope="col">CARD_APP_DATE</th>
                    <th scope="col">CARD_EXPIRY_CCYYMM</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($annual as $annual)
                    <tr>
                        {{-- <td>{{ $annual->NO }}</td> --}}
                        <td>{{ $annual->CARD_CUST_ID }}</td>
                        <td>{{ $annual->CARD_EMBOSSED_NAME }}</td>
                        <td>{{ $annual->CARD_TYPE }}</td>
                        <td>{{ $annual->CARD_CRDACCT_NO }}</td>
                        <td>{{ $annual->CARD_BS_IND }}</td>
                        <td>{{ $annual->CARD_PLASTIC_CODE }}</td>
                        <td>{{ $annual->CRDACCT_STATUS_ID }}</td>
                        <td>{{ $annual->CRDACCT_AGE_CODE }}</td>
                        <td>{{ $annual->CARD_PLASTIC_DATE }}</td>
                        <td>{{ $annual->CARD_APP_DATE }}</td>
                        <td>{{ $annual->CARD_EXPIRY_CCYYMM }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
