@extends('layouts/app')
@section('content')
    <link href="/css/mpu.css" rel="stylesheet">
    <a class="float-start mb-3" title="Back" href="{{ route('MPUHome') }}" role="button"><span class="iconify"
            data-icon="akar-icons:arrow-back-thick" style="color: #d80000;" data-width="25"></span></a>
    <a class="float-start ml-15 mb-3" href="{{ route('downloadinc11s') }}" title="Download"
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
                    <th scope="col">Outgoing_amt_sign</th>
                    <th scope="col">Outgoing_amt</th>
                    <th scope="col">Outgoing_fee_sign</th>
                    <th scope="col">outgoing_fee</th>
                    <th scope="col">incoming_amt_sign</th>
                    <th scope="col">incoming_amt</th>
                    <th scope="col">incoming_fee_sign</th>
                    <th scope="col">incoming_fee</th>
                    <th scope="col">STF_amt_sign</th>
                    <th scope="col">STF_amt</th>
                    <th scope="col">STF_Fee_sign</th>
                    <th scope="col">STF_fee</th>
                    <th scope="col">outgoing_sum</th>
                    <th scope="col">incoming_summary</th>
                    <th scope="col">settlement_curr</th>
                    <th scope="col">reserved</th>
                </tr>
                @foreach ($inc11s as $inc11s)
                    <tr>
                        <td>{{ $inc11s->NO }}</td>
                        <td>{{ $inc11s->recordtype }}</td>
                        <td>{{ $inc11s->member_institution }}</td>
                        <td>{{ $inc11s->Outgoing_amt_sign }}</td>
                        <td>{{ $inc11s->Outgoing_amt }}</td>
                        <td>{{ $inc11s->Outgoing_fee_sign }}</td>
                        <td>{{ $inc11s->outgoing_fee }}</td>
                        <td>{{ $inc11s->incoming_amt_sign }}</td>
                        <td>{{ $inc11s->incoming_amt }}</td>
                        <td>{{ $inc11s->incoming_fee_sign }}</td>
                        <td>{{ $inc11s->incoming_fee }}</td>
                        <td>{{ $inc11s->STF_amt_sign }}</td>
                        <td>{{ $inc11s->STF_amt }}</td>
                        <td>{{ $inc11s->STF_Fee_sign }}</td>
                        <td>{{ $inc11s->STF_fee }}</td>
                        <td>{{ $inc11s->outgoing_summary }}</td>
                        <td>{{ $inc11s->incoming_summary }}</td>
                        <td>{{ $inc11s->settlement_curr }}</td>
                        <td>{{ $inc11s->reserved }}</td>
                    </tr>
                @endforeach
        </table>
    </div>
    </div>
@endsection
