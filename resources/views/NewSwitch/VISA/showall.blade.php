@extends('layouts/app')
@section('content')
    @include('sweetalert::alert')

    <link href="/css/visa.css" rel="stylesheet">
    <a href="{{ route('visa') }}" type="sumbit" class="btn btn-warning btn-rounded float-start mb-3"><span id="span">Add
            New Transactions</span></a>
    <form action="{{ route('visadownload') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-sm-3 col-md-6"> </div>
            <div class="col-sm-9 col-md-6">
                <div class="input-group">
                    <span class="input-group-text">From</span>
                    <input name="startdate" min="2020-01-01" max="2022-12-31" class="form-control" type="text"
                        onfocus="(this.type='date')" id="date">
                    <span class="input-group-text">To</span>
                    <input name="enddate" min="2020-01-01" max="2022-12-31" class="form-control" type="text"
                        onfocus="(this.type='date')" id="date">
                    <button type="submit" class="btn btn-danger">
                        <span class="iconify" data-icon="ic:sharp-sim-card-download" data-width="19"></span>
                    </button>
                </div>
            </div>
        </div>
    </form>
    <div class="scroll-table-container">
        <table class="table-bordered border-white scroll-table">
            <thead>
                <tr>
                    <th scope="col">Settlement Date</th>
                    <th scope="col">Number of Transactions</th>
                    <th scope="col">USD Amount</th>
                    <th scope="col">MMK Amount</th>
                    <th scope="col">Exchange Rate</th>
                    <th scope="col">Net Settlement Amount</th>
                    <th scope="col">Settlement Amount (USD) at Nostro</th>
                    <th scope="col">Funding Date</th>
                    <th scope="col">Commissions Amount</th>
                    <th scope="col">Type of Transaction</th>
                    <th scope="col">Card Type</th>
                    <th scope="col">Authorization Currency</th>
                    <th scope="col">Update</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tranxs as $tranx)
                    <tr>
                        <td>{{ $tranx->settleDate }}</td>
                        <td>{{ $tranx->noTrans }}</td>
                        <td>{{ $tranx->usdAmt }}</td>
                        <td>{{ $tranx->mmkAmt }}</td>
                        <td>{{ $tranx->exRate }}</td>
                        <td>{{ $tranx->netAmt }}</td>
                        <td>{{ $tranx->settAmt_Nostro_USD }}</td>
                        <td>{{ $tranx->fundingDate }}</td>
                        <td>{{ $tranx->commAmt }}</td>
                        <td>{{ $tranx->typeOfTrans }}</td>
                        <td>{{ $tranx->cardType }}</td>
                        <td>{{ $tranx->currency }}</td>
                        <td><a class="btn btn-success" href="{{ route('visaedit', $tranx->id) }}">Update</a>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md-12 mt-3">
        {!! $tranxs->links('custom_pagination') !!}
    </div>
@endsection
