@extends('layouts/app')
@section('content')
    <link href="/css/co.css" rel="stylesheet">
    <div class="mt-3 mb-4 text-center">
        <h2><strong>Ecommerce Transactions</strong></h2>
    </div>
    <form action="{{ route('SaleEcomByAmtprint') }}" method="post">
        @csrf
        <div class="row mt-5 text-center">
            <div class="col-md-4 mb-3">
                <div class="input-group mb-3">
                    <span class="form-control input-group-text" for="browser">Choose Tran Type&nbsp;&nbsp;&nbsp;:</span>
                    <select class="input-group-text form-control" name="trans">
                        <option></option>
                        <option value="SALE_ECOM">SALE_ECOM</option>
                    </select>
                </div>
                @error('trans')
                    <p class="mt-3 text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-md-4">
                <div class="input-group mb-3">
                    <span class="form-control input-group-text">Start Date&nbsp;<span class="iconify"
                            data-icon="flat-color-icons:calendar" data-width="25"></span></span>
                    <input name="start" min="2020-01-01" max="2022-12-31" class="form-control" type="text"
                        onfocus="(this.type='date')" id="date">
                </div>
                @error('start')
                    <p class="mt-3 text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-md-4">
                <div class="input-group mb-3">
                    <span class="form-control input-group-text">End Date&nbsp;<span class="iconify"
                            data-icon="flat-color-icons:calendar" data-width="25"></span></span>
                    <input name="end" min="2020-01-01" max="2022-12-31" class="form-control" type="text"
                        onfocus="(this.type='date')" id="date">
                </div>
                @error('end')
                    <p class="mt-3 text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col">
                <div class="input-group">
                    <div class="col-md-2">
                        <span class="form-control input-group-text">Total Amount :</span>
                    </div>
                    <div class="col-md-2">
                        <select class="input-group-text form-control" name="sign" id="SelectA" onclick="display();">
                            {{-- <option value="" disabled selected>Select your option</option> --}}
                            <option value="All"></option>
                            {{-- <option value="=">equal</option> --}}
                            <option value="between">between</option>
                            <option value="gt">greater than</option>
                            <option value="lt">less than</option>
                            <option value="ge">greater than equal</option>
                            <option value="le">less than equal</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input placeholder="Amount" class="form-control" id="aa" name="reqamt1" type="number">
                        @error('reqamt1')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-1">
                        <strong id="cc" style="display: none;" class="form-control">&nbsp;To&nbsp;</strong>
                    </div>
                    <div class="col-md-2">
                        <input placeholder="Amount" style="display: none;" class="form-control" id="bb"
                            name="reqamt2" type="number">
                        @error('reqamt2')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="sumbit" class="btn btn-danger mt-5"><span class="iconify" data-icon="line-md:search"
                    data-width="20"></span><strong> Search</strong></button>
        </div>
        <script>
            function display() {
                var x = document.getElementById('SelectA').value;
                if (x == "between") {
                    document.getElementById("aa").style.display = "block";
                    document.getElementById("bb").style.display = "block";
                    document.getElementById("cc").style.display = "block";
                } else {
                    document.getElementById("aa").style.display = "block";
                    document.getElementById("bb").style.display = "none";
                    document.getElementById("cc").style.display = "none";
                }
            }
        </script>
    </form>
@endsection
