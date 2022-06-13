@extends('layouts/app')
@section('content')
    <link href="/css/pssd.css" rel="stylesheet">
    <a class="float-start mb-3" href="{{ route('pssd02home') }}" role="button"><span class="iconify"
            data-icon="akar-icons:arrow-back-thick" style="color: #2bd800;" data-width="25"></span></a>
    <a class="float-start ml-15 mb-3" href="{{ route('pssd02download', $date) }}"
        onclick="return confirm('Are you sure you want to download?')" role="button">&nbsp;&nbsp;&nbsp;<span
            class="iconify" data-icon="ic:sharp-sim-card-download" style="color: #2bd800;" data-width="25"></span></a>
    <span class="float-end mb-3 text-success">Report Date : {{ $date }}</span>
    <div class="scroll-table-container">
        <table class="table-bordered border-black scroll-table">
            <thead>
                <tr>
                    <th scope="col">Report_Date</th>
                    <th scope="col">Card_Name</th>
                    <th scope="col">Transaction_Date</th>
                    <th scope="col">Category_of_Card</th>
                    <th scope="col">CURRENCY</th>
                    <th scope="col">Source</th>
                    <th scope="col">Used_Location</th>
                    <th scope="col">Number_of_Acquire_Transaction</th>
                    <th scope="col">Acquire_Transaction_Amount</th>
                    <th scope="col">Acquire_Transaction_Amount_USD</th>
                    <th scope="col">Acquire_Transaction_Amount_MMK</th>
                    <th scope="col">Commision_Amount</th>
                    <th scope="col">Commision_Amount_USD</th>
                    <th scope="col">Commision_Amount_MMK</th>
                    <th scope="col">Remark</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pssd02 as $pssd02)
                    <tr>
                        <td>{{ $pssd02->Report_Date }}</td>
                        <td>{{ $pssd02->Card_Name }}</td>
                        <td>{{ $pssd02->Transaction_Date }}</td>
                        <td>{{ $pssd02->Category_of_Card }}</td>
                        <td>{{ $pssd02->CURRENCY }}</td>
                        <td>{{ $pssd02->Source }}</td>
                        <td>{{ $pssd02->Used_Location }}</td>
                        <td>{{ $pssd02->Number_of_Acquire_Transaction }}</td>
                        <td>{{ $pssd02->Acquire_Transaction_Amount }}</td>
                        <td>{{ $pssd02->Acquire_Transaction_Amount_USD }}</td>
                        <td>{{ $pssd02->Acquire_Transaction_Amount_MMK }}</td>
                        <td>{{ $pssd02->Commision_Amount }}</td>
                        <td>{{ $pssd02->Commision_Amount_USD }}</td>
                        <td>{{ $pssd02->Commision_Amount_MMK }}</td>
                        <td>{{ $pssd02->Remark }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
