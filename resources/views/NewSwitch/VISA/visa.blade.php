@extends('layouts/app')
@section('content')
    @include('sweetalert::alert')
    <link href="/css/visa.css" rel="stylesheet">
    <div class="mt-5 text-center">
        <a href="{{ route('showall') }}" type="sumbit" class="btn btn-warning btn-rounded float-end"><span id="span">Show
                All</span></a>
        <h2><span class="iconify" data-icon="logos:visa" data-width="80">
            </span><strong> Create Transactions</strong>
        </h2>
    </div>
    <form action="{{ route('insert') }}" method="post">
        @csrf
        <div class="row mt-5">
            <div class="col">
                @error('settledate')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <div class="input-group mb-3">
                    <span class="input-group-text">Settle Date&nbsp;<span class="iconify"
                            data-icon="flat-color-icons:calendar" data-width="25"></span></span>
                    <input name="settledate" min="2020-01-01" max="2022-12-31" class="form-control" type="text"
                        onfocus="(this.type='date')" id="date">
                </div>
            </div>
            <div class="col">
                @error('num')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <div class="input-group mb-3">
                    <span class="input-group-text">Number of Transactions</span>
                    <input name="num" class="form-control" type="number" step="0.01">
                </div>
            </div>
            <div class="col">
                @error('usd')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <div class="input-group mb-3">
                    <span class="input-group-text">USD Amount</span>
                    <input name="usd" class="form-control" type="number" step="0.01">
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                @error('mmk')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <div class="input-group mb-3">
                    <span class="input-group-text">MMK Amount</span>
                    <input name="mmk" class="form-control" type="number" step="0.01">
                </div>
            </div>
            <div class="col">
                @error('Net')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <div class="input-group mb-3">
                    <span class="input-group-text">Net Settle Amount</span>
                    <input name="Net" class="form-control" type="number" step="0.01">
                </div>
            </div>
            <div class="col">
                @error('settAmt_Nostro_USD')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <div class="input-group mb-3">
                    <span class="input-group-text">USD at Nostro Settle Amount</span>
                    <input name="settAmt_Nostro_USD" class="form-control" type="number" step="0.01">
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                @error('fundingDate')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <div class="input-group mb-3">
                    <span class="input-group-text">Funding Date&nbsp;<span class="iconify"
                            data-icon="flat-color-icons:calendar" data-width="25"></span></span>
                    <input name="fundingDate" min="2020-01-01" max="2022-12-31" class="form-control" type="text"
                        onfocus="(this.type='date')" id="date">
                </div>
            </div>
            <div class="col">
                @error('rate')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <div class="input-group mb-3">
                    <span class="input-group-text">Exchange Rate</span>
                    <input name="rate" class="form-control" type="number" step="0.01">
                </div>
            </div>
            <div class="col">
                @error('commAmt')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <div class="input-group mb-3">
                    <span class="input-group-text">Commissions Amount</span>
                    <input name="commAmt" class="form-control" type="number" step="0.01">
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <span for="cardType">Select Card Type : </span>
                <select name="cardType" id="terminal">
                    <option selected></option>
                    <option value="Debit">Debit</option>
                    <option value="Credit">Credit</option>
                    <option value="Prepaid">Prepaid</option>
                </select>
                @error('cardType')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col">
                <label for="terminal">Select Currency : </label>
                <select name="currency" id="terminal">
                    <option selected></option>
                    <option value="mmk">MMK</option>
                    <option value="usd">USD</option>
                </select>
                @error('currency')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col">
                <label for="terminal">Select Type of Transaction : </label>
                <select name="typeOfTrans" id="terminal">
                    <option selected></option>
                    <option value="visapos">VISA_POS</option>
                    <option value="visaatm">VISA_ATM</option>
                    <option value="masterpos">Master_POS</option>
                    <option value="masteratm">Master_ATM</option>
                    <option value="upipos">UPI_POS</option>
                    <option value="upiatm">UPI_ATM</option>
                    <option value="jcbpos">JCB_POS</option>
                    <option value="jcbatm">JCB_ATM</option>
                </select>
                @error('typeOfTrans')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div>
            <div class="text-center">
                <button type="submit" class="btn btn-warning mt-5 "><i
                        class="mt-1 far fa-save fa-2x"></i><span id="span">&nbsp;&nbsp;Save Now</span></button>
            </div>
    </form>
@endsection
