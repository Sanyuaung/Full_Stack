@extends('layouts/app')
@section('content')
    <link href="/css/co.css" rel="stylesheet">
    <div class="mt-5 mb-4 text-center">
        <h2><strong>Customer Oustanding reports</strong></h2>
    </div>
    <form action="{{ route('coprint') }}" method="post">
        @csrf
        <div class="input-group mt-5">
            <span id="span" class="input-group-text">Report Date&nbsp;<span class="iconify"
                    data-icon="flat-color-icons:calendar" data-width="25"></span></span>
            <input name="month" type="text" onfocus="(this.type='month')" id="date" class="form-control"
                min="2020-01" max="2022-12" />
        </div>
        @error('month')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        <div class="row mt-5 text-center">
            <div class="col">
                <label for="browser">Choose Branch list:</label>
                <input list="browsers" name="branch" id="browser">
                <datalist id="browsers">
                    <option value="ALL">
                    <option value="AHL">
                    <option value="BAGO">
                    <option value="BGN">
                    <option value="BOG">
                    <option value="BYN">
                    <option value="DWI">
                    <option value="EME">
                    <option value="HO">
                    <option value="HO_CC">
                    <option value="HO_CRDCOLL">
                    <option value="HPAN">
                    <option value="HTD">
                    <option value="HTY">
                    <option value="KGK">
                    <option value="KMYT">
                    <option value="LMD">
                    <option value="LTA">
                    <option value="MAG">
                    <option value="MDW">
                    <option value="MDY">
                    <option value="MDY-35">
                    <option value="MDY-84">
                    <option value="MDY-DP">
                    <option value="MGWE">
                    <option value="MHL">
                    <option value="MLM">
                    <option value="MMA">
                    <option value="MMZ">
                    <option value="MUS">
                    <option value="MYEIK">
                    <option value="MYWA">
                    <option value="N/OKA">
                    <option value="NDGM">
                    <option value="NDGN">
                    <option value="NPI">
                    <option value="NPT">
                    <option value="NTG">
                    <option value="OSP">
                    <option value="PDE">
                    <option value="PLW">
                    <option value="POL">
                    <option value="PTN">
                    <option value="PYAY">
                    <option value="SBT">
                    <option value="SML">
                    <option value="SOKA">
                    <option value="TDG">
                    <option value="TGU">
                    <option value="TME">
                    <option value="WLT">
                    <option value="YE-U">
                    <option value="ZGN">
                </datalist>
                @error('branch')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="text-center">
            <button type="sumbit" class="btn btn-danger mt-5"><span class="iconify" data-icon="line-md:search"
                    data-width="20"></span><strong> Search</strong></button>
        </div>
    </form>
@endsection
