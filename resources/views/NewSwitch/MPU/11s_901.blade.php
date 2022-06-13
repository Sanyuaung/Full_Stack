@extends('layouts/app')
@section('content')
    <link href="/css/mpu.css" rel="stylesheet">
    <a class="float-start mb-3" title="Back" href="{{ route('MPUHome') }}" role="button"><span class="iconify"
            data-icon="akar-icons:arrow-back-thick" style="color: #d80000;" data-width="25"></span></a>
    <a class="float-start ml-15 mb-3" href="{{ route('downloadinc11s_901') }}" title="Download"
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
                @foreach ($inc11s_901 as $inc11s_901)
                    <tr>
                        <td>{{ $inc11s_901->NO }}</td>
                        <td>{{ $inc11s_901->recordtype }}</td>
                        <td>{{ $inc11s_901->member_institution }}</td>
                        <td>{{ $inc11s_901->curr_code }}</td>
                        <td>{{ $inc11s_901->statistics_txn_code }}</td>
                        <td>{{ $inc11s_901->no_txn_summary }}</td>
                        <td>{{ $inc11s_901->credit_amt }}</td>
                        <td>{{ $inc11s_901->debit_amt }}</td>
                        <td>{{ $inc11s_901->reserved }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
