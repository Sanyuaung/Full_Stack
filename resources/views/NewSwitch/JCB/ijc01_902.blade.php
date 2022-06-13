@extends('layouts/app')
@section('content')
    <link href="/css/mpu.css" rel="stylesheet">
    <a class="float-start mb-3" title="Back" href="{{ route('MPUHome') }}" role="button"><span class="iconify"
            data-icon="akar-icons:arrow-back-thick" style="color: #d80000;" data-width="25"></span></a>
    <a class="float-start ml-15 mb-3" href="{{ route('downlodijc01_902') }}" title="Download"
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
                @foreach ($ijc01_902 as $ijc01_902)
                    <tr>
                        <td>{{ $ijc01_902->NO }}</td>
                        <td>{{ $ijc01_902->recordtype }}</td>
                        <td>{{ $ijc01_902->member_institution }}</td>
                        <td>{{ $ijc01_902->curr_code }}</td>
                        <td>{{ $ijc01_902->statistics_txn_code }}</td>
                        <td>{{ $ijc01_902->no_txn_summary }}</td>
                        <td>{{ $ijc01_902->credit_amt }}</td>
                        <td>{{ $ijc01_902->debit_amt }}</td>
                        <td>{{ $ijc01_902->reserved }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
