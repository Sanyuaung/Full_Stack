@extends('layouts/app')
@section('content')
    <link href="/css/cardlist.css" rel="stylesheet">
    <a class="float-start mb-3" href="{{ route('cardhome') }}" role="button"><span class="iconify"
            data-icon="akar-icons:arrow-back-thick" style="color: #d80000;" data-width="25"></span></a>
    <a class="float-start ml-15 mb-3" href="{{ route('cardlistdownload', ['startdate' => $startdate, 'enddate' => $enddate,'brand'=>$brand]) }}"
        onclick="return confirm('Are you sure you want to download?')" role="button">&nbsp;&nbsp;&nbsp;<span
            class="iconify" data-icon="ic:sharp-sim-card-download" style="color: #d80000;" data-width="25"></span></a>
    <span class="float-end mb-3">From {{ $startdate }} to {{ $enddate }}</span>
    <div class="mt-3 scroll-table-container">
        <table class="table-bordered border-white scroll-table">
            <thead>
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">Date</th>
                    <th scope="col">CARD_BRANCH_ID</th>
                    <th scope="col">CARD_CARDPLAN_ID</th>
                    <th scope="col">Count</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($db as $db)
                    <tr>
                        <td>{{ $db->NO }}</td>
                        <td>{{ $db->Date }}</td>
                        <td>{{ $db->CARD_BRANCH_ID }}</td>
                        <td>{{ $db->CARD_CARDPLAN_ID }}</td>
                        <td>{{ $db->Count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
