@extends('layouts/app')
@section('content')
    <link href="/css/co.css" rel="stylesheet">
    <a class="float-start mb-3" href="{{ route('cohome') }}" role="button"><span class="iconify"
            data-icon="akar-icons:arrow-back-thick" style="color: #d80000;" data-width="25"></span></a>
    <a class="float-start ml-15 mb-3" href="{{ route('codownload', $date) }}"
        onclick="return confirm('Are you sure you want to download?')" role="button">&nbsp;&nbsp;&nbsp;<span
            class="iconify" data-icon="ic:sharp-sim-card-download" style="color: #d80000;" data-width="25"></span></a>
    <span class="float-end mb-3">Report Date :
        {{ $date }}</span>
    <div class="scroll-table-container">
        <table class="table-bordered border-white scroll-table">
            <thead>
                <tr>
                    <th scope="col">CUST_ID</th>
                    <th scope="col">CUST_NAME</th>
                    <th scope="col">CONTACT_NAME</th>
                    <th scope="col">CONTACT_BIRTH_DATE</th>
                    <th scope="col">CONTACT_IC</th>
                    <th scope="col">CONTACT_MOBILE</th>
                    <th scope="col">CARD_CARDPLAN_ID</th>
                    <th scope="col">CONTACT_EMPLOYER_NAME</th>
                    <th scope="col">CONTACT_STAFF</th>
                    <th scope="col">CUST_BRANCH_ID</th>
                    <th scope="col">ACCOUNT_NO</th>
                    <th scope="col">STMT_MONTH</th>
                    <th scope="col">CURRENCY</th>
                    <th scope="col">OPEN_BALANCE</th>
                    <th scope="col">ACCGRPLMT_CREDIT_LMT</th>
                    <th scope="col">CLOSE_BALANCE</th>
                    <th scope="col">CURR_AGE_CODE</th>
                    <th scope="col">STATUS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($co as $co)
                    <tr>
                        <td>{{ $co->CUST_ID }}</td>
                        <td>{{ $co->CUST_NAME }}</td>
                        <td>{{ $co->CONTACT_NAME }}</td>
                        <td>{{ $co->CONTACT_BIRTH_DATE }}</td>
                        <td>{{ $co->CONTACT_IC }}</td>
                        <td>{{ $co->CONTACT_MOBILE }}</td>
                        <td>{{ $co->CARD_CARDPLAN_ID }}</td>
                        <td>{{ $co->CONTACT_EMPLOYER_NAME }}</td>
                        <td>{{ $co->CONTACT_STAFF }}</td>
                        <td>{{ $co->CUST_BRANCH_ID }}</td>
                        <td>{{ $co->ACCOUNT_NO }}</td>
                        <td>{{ $co->STMT_MONTH }}</td>
                        <td>{{ $co->CURRENCY }}</td>
                        <td>{{ $co->OPEN_BALANCE }}</td>
                        <td>{{ $co->ACCGRPLMT_CREDIT_LMT }}</td>
                        <td>{{ $co->CLOSE_BALANCE }}</td>
                        <td>{{ $co->CURR_AGE_CODE }}</td>
                        <td>{{ $co->STATUS }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
