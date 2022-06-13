@extends('layouts/app')
@section('content')
    <link href="/css/atm.css" rel="stylesheet">
    <a class="float-start mb-3" href="{{ route('atmhome') }}" role="button"><span class="iconify"
            data-icon="akar-icons:arrow-back-thick" style="color: #d80000;" data-width="25"></span></a>
    <a class="float-start ml-15 mb-3" href="{{ route('atmdownload', ['startdate' => $startdate, 'enddate' => $enddate]) }}"
        onclick="return confirm('Are you sure you want to download?')" role="button">&nbsp;&nbsp;&nbsp;<span
            class="iconify" data-icon="ic:sharp-sim-card-download" style="color: #d80000;" data-width="25"></span></a>
    <span class="float-end mb-3">From {{ $startdate }} to {{ $enddate }}</span>
    <div class="mt-3 scroll-table-container">
        <table class="table-bordered border-white scroll-table">
            <thead>
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">ATM ID</th>
                    <th scope="col">ATM Location</th>
                    <th scope="col">Downtime</th>
                    <th scope="col">Downtime Percentage</th>
                    <th scope="col">Available Percentage</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($atm as $atm)
                    <tr>
                        <td>{{ $atm->NO }}</td>
                        <td>{{ $atm->ATM_ID }}</td>
                        <td>{{ $atm->ATM_LOCATION }}</td>
                        <td>{{ $atm->DOWNTIME }}</td>
                        <td>{{ $atm->DOWNTIME_PERCENT }}</td>
                        <td>{{ $atm->AVALIABLE_PERCENT }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
