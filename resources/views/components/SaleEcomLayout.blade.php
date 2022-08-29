@extends('layouts/app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <ul class=" list-group mt-3">
                    <li class="text-center list-group-item"><a href="{{ route('SaleEcomAll') }}">ALL Transactions</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-6">
                <ul class="list-group mt-3">
                    <li class="text-center list-group-item"><a href="{{ route('SaleEcomByAmt') }}">Transactions By Amount</a>
                    </li>
                </ul>
            </div>
            <div class="col">
                {{ $slot }}
            </div>
        </div>
    </div>
@endsection
