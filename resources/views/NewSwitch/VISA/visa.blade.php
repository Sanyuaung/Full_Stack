@extends('layouts/app')
@section('content')
    @include('sweetalert::alert')
    <link href="/css/visa.css" rel="stylesheet">
    <div class="mt-3 text-center">
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
                <label for="browser">Card Type : </label>
                <input list="cards" name="cardType" id="browser">
                <datalist id="cards">
                    <option value="DEBIT">
                    <option value="CREDIT">
                    <option value="PREPAID">
                </datalist>
                @error('cardType')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col">
                <label for="browser">Currency : </label>
                <input list="currencys" name="currency" id="browser">
                <datalist id="currencys">
                    <option value="MMK">
                    <option value="USD">
                </datalist>
                @error('currency')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col">
                <label for="browser">Issuer Country : </label>
                <input list="countries" name="country" id="browser">
                <datalist id="countries">
                    <option value="DOMESTIC">
                    <option value="INTERNATIONAL">
                </datalist>
                @error('country')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="row mt-4">
            <div class="col">
                <label for="browser">Type of Transaction : </label>
                <input list="trans" name="typeOfTrans" id="browser">
                <datalist id="trans">
                    <option value="VISAPOS">
                    <option value="VISAATM">
                    <option value="MASTERPOS">
                    <option value="MASTERATM">
                    <option value="UPIPOS">
                    <option value="UPIATM">
                    <option value="JCBPOS">
                    <option value="JCBATM">
                </datalist>
                @error('typeOfTrans')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col">
            </div>
            <div class="col">
            </div>
        </div>
        <div>
            <div class="text-center">
                <button type="submit" class="btn btn-warning mt-5"><i class="mt-1 far fa-save fa-2x"></i><span
                        id="span">&nbsp;&nbsp;Save Now</span></button>
            </div>
        </div>
    </form>
@endsection
