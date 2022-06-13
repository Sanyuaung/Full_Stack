@extends('layouts/app')
@section('content')
    <link href="/css/pssd.css" rel="stylesheet">
    <a class="float-start mb-3" href="{{ route('pssd01home') }}" role="button"><span class="iconify"
            data-icon="akar-icons:arrow-back-thick" style="color: #2bd800;" data-width="25"></span></a>
    <a class="float-start ml-15 mb-3" href="{{ route('pssd01download', $date) }}"
        onclick="return confirm('Are you sure you want to download?')" role="button">&nbsp;&nbsp;&nbsp;<span
            class="iconify" data-icon="ic:sharp-sim-card-download" style="color: #2bd800;" data-width="25"></span></a>
    <span class="float-end mb-3 text-success">Report Date : {{ $date }}</span>
    <div class="scroll-table-container">
        <table class="table-bordered border-black scroll-table">
            <thead>
                <tr>
                    <th scope="col">Report Date</th>
                    <th scope="col">Card Name</th>
                    <th scope="col">Category of Card</th>
                    <th scope="col">Currency</th>
                    <th scope="col">Used Location</th>
                    <th scope="col">Used Card Quantity</th>
                    <th scope="col">Transaction Count</th>
                    <th scope="col">Used Card Transaction Amount</th>
                    <th scope="col">Used Card Transaction Amount_MMK</th>
                    <th scope="col">Remark</th>
                    <th scope="col">Sold Transaction Count</th>
                    <th scope="col">Sold Transaction Amount</th>
                    <th scope="col">Sold Transaction Amount_USD</th>
                    <th scope="col">Sold Transaction Amount_MMK</th>
                    <th scope="col">Used Card Transaction Amount_USD</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($pssd01 as $pssd01)
                    <tr>
                        {{-- <td>{{ $pssd01->NO }}</td> --}}
                        <td>{{ $pssd01->Report_Date }}</td>
                        <td>{{ $pssd01->Card_Name }}</td>
                        <td>{{ $pssd01->Category_of_Card }}</td>
                        <td>{{ $pssd01->Currency }}</td>
                        <td>{{ $pssd01->Used_Location }}</td>
                        <td>{{ $pssd01->Used_Card_Quantity }}</td>
                        <td>{{ $pssd01->Transaction_Count }}</td>
                        <td>{{ $pssd01->Used_Card_Transaction_Amount }}</td>
                        <td>{{ $pssd01->Used_Card_Transaction_Amount_MMK }}</td>
                        <td>{{ $pssd01->Remark }}</td>
                        <td>{{ $pssd01->Sold_Transaction_Count }}</td>
                        <td>{{ $pssd01->Sold_Transaction_Amount }}</td>
                        <td>{{ $pssd01->Sold_Transaction_Amount_USD }}</td>
                        <td>{{ $pssd01->Sold_Transaction_Amount_MMK }}</td>
                        <td>{{ $pssd01->Used_Card_Transaction_Amount_USD }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
