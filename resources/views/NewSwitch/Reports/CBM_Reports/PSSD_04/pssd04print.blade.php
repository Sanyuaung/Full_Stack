@extends('layouts/app')
@section('content')
    <link href="/css/pssd.css" rel="stylesheet">
    <a class="float-start mb-3" href="{{ route('pssd04home') }}" role="button"><span class="iconify"
            data-icon="akar-icons:arrow-back-thick" style="color: #2bd800;" data-width="25"></span></a>
    <a class="float-start ml-15 mb-3" href="{{ route('pssd04download', $date) }}"
        onclick="return confirm('Are you sure you want to download?')" role="button">&nbsp;&nbsp;&nbsp;<span
            class="iconify" data-icon="ic:sharp-sim-card-download" style="color: #2bd800;" data-width="25"></span></a>
    <span class="float-end mb-3 text-success">Report Date : {{ $date }}</span>
    <div class="mt-3 scroll-table-container">
        <table class="table-bordered border-black scroll-table">
            <thead>
                <tr>
                    <th scope="col">Report Date</th>
                    <th scope="col">Card Name </th>
                    <th scope="col">Category of Card</th>
                    <th scope="col">No of Used Card</th>
                    <th scope="col">Category of Transaction</th>
                    <th scope="col">CURRENCY CODE</th>
                    <th scope="col">Source</th>
                    <th scope="col">No of transactions</th>
                    <th scope="col">Transaction Amount</th>
                    <th scope="col">Transaction Amount MMK</th>
                    <th scope="col">Remark</th>
                    <th scope="col">Transaction Amount USD</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pssd04 as $pssd04)
                    <tr>
                        {{-- <td>{{ $pssd04->NO }}</td> --}}
                        <td>{{ $pssd04->Report_Date }}</td>
                        <td>{{ $pssd04->Card_Name }}</td>
                        <td>{{ $pssd04->Category_of_Card }}</td>
                        <td>{{ $pssd04->No_of_Used_Card }}</td>
                        <td>{{ $pssd04->Category_of_Transaction }}</td>
                        <td>{{ $pssd04->CURRENCY_CODE }}</td>
                        <td>{{ $pssd04->Source }}</td>
                        <td>{{ $pssd04->No_of_transactions }}</td>
                        <td>{{ $pssd04->Transaction_Amount }}</td>
                        <td>{{ $pssd04->Txn_Amt_MMK }}</td>
                        <td>{{ $pssd04->Remark }}</td>
                        <td>{{ $pssd04->Transaction_Amount_USD }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
