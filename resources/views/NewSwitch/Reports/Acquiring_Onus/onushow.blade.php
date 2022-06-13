@extends('layouts/app')
@section('content')
    <link href="/css/cardlist.css" rel="stylesheet">
    <a class="float-start mb-3" href="{{ route('onushome') }}" role="button"><span class="iconify"
            data-icon="akar-icons:arrow-back-thick" style="color: #d80000;" data-width="25"></span></a>
    <a class="float-start ml-15 mb-3"
        href="{{ route('onusdownload', ['startdate' => $startdate, 'enddate' => $enddate]) }}"
        onclick="return confirm('Are you sure you want to download?')" role="button">&nbsp;&nbsp;&nbsp;<span
            class="iconify" data-icon="ic:sharp-sim-card-download" style="color: #d80000;" data-width="25"></span></a>
    <span class="float-end mb-3">From {{ $startdate }} to {{ $enddate }}</span>
    <div class="mt-3 scroll-table-container">
        <table class="table-bordered border-white scroll-table">
            <thead>
                <tr>
                    <th scope="col">Month</th>
                    <th scope="col">Card_Name</th>
                    <th scope="col">Category_of_Transaction</th>
                    <th scope="col">Source</th>
                    <th scope="col">No_of_transactions</th>
                    <th scope="col">Transaction_Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($db as $db)
                    <tr>
                        <td>{{ $db->Month }}</td>
                        <td>{{ $db->Card_Name }}</td>
                        <td>{{ $db->Category_of_Transaction }}</td>
                        <td>{{ $db->Source }}</td>
                        <td>{{ $db->No_of_transactions }}</td>
                        <td>{{ $db->Transaction_Amount }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
