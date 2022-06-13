@extends('layouts/app')
@section('content')
    <link href="/css/mpu.css" rel="stylesheet">
    <a class="float-start mb-3" title="Back" href="{{ route('MPUHome') }}" role="button"><span class="iconify"
            data-icon="akar-icons:arrow-back-thick" style="color: #d80000;" data-width="25"></span></a>
    <a class="float-start ml-15 mb-3" href="{{ route('downloadincSCOM_901902') }}" title="Download"
        onclick="return confirm('Are you sure you want to download?')" role="button">&nbsp;&nbsp;&nbsp;<span
            class="iconify" data-icon="ic:sharp-sim-card-download" style="color: #d80000;" data-width="25"></span></a>
    <span class="float-end mb-3 text-danger">{{ $filename }}</span></span>
    <div class="mt-3 scroll-table-container">
        <table class="table-bordered border-white scroll-table">
            <thead>
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">recordtype</th>
                    <th scope="col">member_institution</th>
                    <th scope="col">curr_code</th>
                    <th scope="col">statistics_txn_code</th>
                    <th scope="col">no_txn_summary</th>
                    <th scope="col">credit_amt</th>
                    <th scope="col">debit_amt</th>
                    <th scope="col">reserved</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($scom_901902 as $scom_901902)
                    <tr>
                        <td>{{ $scom_901902->NO }}</td>
                        <td>{{ $scom_901902->recordtype }}</td>
                        <td>{{ $scom_901902->member_institution }}</td>
                        <td>{{ $scom_901902->curr_code }}</td>
                        <td>{{ $scom_901902->statistics_txn_code }}</td>
                        <td>{{ $scom_901902->no_txn_summary }}</td>
                        <td>{{ $scom_901902->credit_amt }}</td>
                        <td>{{ $scom_901902->debit_amt }}</td>
                        <td>{{ $scom_901902->reserved }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
