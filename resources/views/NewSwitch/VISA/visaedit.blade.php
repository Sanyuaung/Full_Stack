@extends('layouts/app')
@section('content')
    @include('sweetalert::alert')
    <link href="/css/visa.css" rel="stylesheet">
    <div class="mt-3 text-center">
        <a class="float-start mb-3" title="Back" href="{{ route('showall') }}" role="button"><span class="iconify"
                data-icon="akar-icons:arrow-back-thick" style="color: #0d38f7;" data-width="25"></span></a>
        <h2><span class="iconify" data-icon="logos:visa" data-width="80">
            </span><strong> Update Transactions</strong>
        </h2>
    </div>
    <form action="{{ route('visaupdate', $edittran->id) }}" method="post">
        @csrf
        <div class="row mt-5">
            <div class="col">
                @error('settledate')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <div class="input-group mb-3">
                    <span class="input-group-text">Settle Date&nbsp;<span class="iconify"
                            data-icon="flat-color-icons:calendar" data-width="25"></span></span>
                    <input name="settledate" min="2020-01-01" max="2022-12-31" class="form-control"
                        value="{{ $edittran->settleDate }}"oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                        type="number" maxlength="8" placeholder="YYYYMMDD">
                </div>
            </div>
            <div class="col">
                @error('num')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <div class="input-group mb-3">
                    <span class="input-group-text">Number of Transactions</span>
                    <input name="num" class="form-control" type="number" step="0.01"
                        value="{{ $edittran->noTrans }}">
                </div>
            </div>
            <div class="col">
                @error('usd')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <div class="input-group mb-3">
                    <span class="input-group-text">USD Amount</span>
                    <input name="usd" class="form-control" type="number" step="0.01"
                        value="{{ $edittran->usdAmt }}">
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
                    <input name="mmk" class="form-control" type="number" step="0.01"
                        value="{{ $edittran->mmkAmt }}">
                </div>
            </div>
            <div class="   col">
                @error('Net')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <div class="input-group mb-3">
                    <span class="input-group-text">Net Settle Amount</span>
                    <input name="Net" class="form-control" type="number" step="0.01"
                        value="{{ $edittran->netAmt }}">
                </div>
            </div>
            <div class="col">
                @error('settAmt_Nostro_USD')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <div class="input-group mb-3">
                    <span class="input-group-text">USD at Nostro Settle Amount</span>
                    <input name="settAmt_Nostro_USD" class="form-control" type="number" step="0.01" placeholder="0.00"
                        value="{{ $edittran->settAmt_Nostro_USD }}">
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
                    <input name="fundingDate" min="2020-01-01" max="2022-12-31" class="form-control"
                        value="{{ $edittran->fundingDate }}"
                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                        type="number" maxlength="8" placeholder="YYYYMMDD">
                </div>
            </div>
            <div class="col">
                @error('rate')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <div class="input-group mb-3">
                    <span class="input-group-text">Exchange Rate</span>
                    <input name="rate" class="form-control" type="number" step="0.01"
                        value="{{ $edittran->exRate }}">
                </div>
            </div>
            <div class="col">
                @error('commAmt')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <div class="input-group mb-3">
                    <span class="input-group-text">Commissions Amount</span>
                    <input name="commAmt" class="form-control" type="number" step="0.01"
                        value="{{ $edittran->commAmt }}">
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <span for="cardType">Card Type : </span>
                <select name="cardType" id="terminal">
                    <option value="DEBIT"{{ $edittran->cardType == 'Debit' ? 'selected' : '' }}>
                        DEBIT</option>
                    <option value="CREDIT"{{ $edittran->cardType == 'Credit' ? 'selected' : '' }}>
                        CREDIT</option>
                    <option value="PREPAID"{{ $edittran->cardType == 'Prepaid' ? 'selected' : '' }}>
                        PREPAID</option>
                    <option value=""{{ $edittran->cardType == '' ? 'selected' : '' }}>
                    </option>
                </select>
                @error('cardType')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col">
                <label for="terminal">Currency : </label>
                <select name="currency" id="terminal">
                    <option value="MMK"{{ $edittran->currency == 'MMK' ? 'selected' : '' }}>
                        MMK</option>
                    <option value="USD"{{ $edittran->currency == 'USD' ? 'selected' : '' }}>
                        USD</option>
                    <option value=""{{ $edittran->currency == '' ? 'selected' : '' }}>
                    </option>
                </select>
                @error('currency')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col">
                <label for="terminal">Issuer Country : </label>
                <select name="country" id="terminal">
                    <option value="DOMESTIC"{{ $edittran->country == 'DOMESTIC' ? 'selected' : '' }}>
                        DOMESTIC</option>
                    <option value="INTERNATIONAL"{{ $edittran->country == 'INTERNATIONAL' ? 'selected' : '' }}>
                        INTERNATIONAL</option>
                    <option value=""{{ $edittran->country == '' ? 'selected' : '' }}>
                    </option>
                </select>
                @error('country')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="row mt-4">
            <div class="col">
                <label for="terminal">Type of Transaction : </label>
                <select name="typeOfTrans" id="terminal">
                    <option value="VISAPOS"{{ $edittran->typeOfTrans == 'VISAPOS' ? 'selected' : '' }}>
                        VISAPOS</option>
                    <option value="VISAATM"{{ $edittran->typeOfTrans == 'VISAATM' ? 'selected' : '' }}>
                        VISAATM</option>
                    <option value="MASTERPOS"{{ $edittran->typeOfTrans == 'MASTERPOS' ? 'selected' : '' }}>
                        MASTERPOS</option>
                    <option value="MASTERATM"{{ $edittran->typeOfTrans == 'MASTERATM' ? 'selected' : '' }}>
                        MASTERATM</option>
                    <option value="UPIPOS"{{ $edittran->typeOfTrans == 'UPIPOS' ? 'selected' : '' }}>
                        UPIPOS</option>
                    <option value="UPIATM"{{ $edittran->typeOfTrans == 'UPIATM' ? 'selected' : '' }}>
                        UPIATM</option>
                    <option value="JCBPOS"{{ $edittran->typeOfTrans == 'JCBPOS' ? 'selected' : '' }}>
                        JCBPOS</option>
                    <option value="JCBATM"{{ $edittran->typeOfTrans == 'JCBATM' ? 'selected' : '' }}>
                        JCBATM</option>
                    <option value="{{ $edittran->typeOfTrans }}"{{ $edittran->typeOfTrans == '' ? 'selected' : '' }}>
                    </option>
                </select>
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
                <button type="submit" class="btn btn-warning mt-5 "><i class="mt-1 far fa-save fa-2x"></i><span
                        id="span">&nbsp;&nbsp;Update Now</span></button>
            </div>
        </div>
    </form>
@endsection
