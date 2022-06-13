@extends('layouts/app')
@section('content')
    @include('sweetalert::alert')

    <link href="/css/visa.css" rel="stylesheet">
    <div class="mt-5 text-center mb-4">
        <h2><strong>Add today currency Rate</strong>
        </h2>
    </div>
    <form action="{{ route('ccyinsert') }}" method="post">
        @csrf
        @error('date')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        <div class="input-group mb-4">
            <span class="input-group-text">Date&nbsp;<span class="iconify"
                    data-icon="flat-color-icons:calendar" data-width="25"></span></span>
            <input name="date" min="2020-01-01" max="2022-12-31" type="text" onfocus="(this.type='date')" id="date"
                class="form-control" />
        </div>
        @error('rate')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        <div class="input-group mb-4">
            <span class="input-group-text">Mid rate</span>
            <input name="rate" type="number" step="0.01" class="form-control" />
        </div>
        @error('ccy')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        <div class="input-group mb-4">
            <span class="input-group-text">Select Currency : </span>
            <select class="form-control" name="ccy" id="terminal">
                <option selected></option>
                <option value="USD">USD</option>
                {{-- <option value="THB">THB</option>
                            <option value="EUR">EUR</option> --}}
            </select>
        </div>
        {{-- <button type="sumbit" class="btn btn-warning btn-rounded"><strong>Add Now</strong></button> --}}
        <div class="text-center">
            <button type="submit" class="btn btn-warning mt-3 "><strong>Add Now</strong></button>
        </div>
    </form>
@endsection
