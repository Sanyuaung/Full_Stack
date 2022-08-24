@extends('layouts/app')
@section('content')
    <link href="/css/co.css" rel="stylesheet">
    <div class="mt-5 mb-4 text-center">
        <h2><strong>Credit Card AnnualFee Listing</strong></h2>
    </div>
    <form action="{{ route('AnnualFeeListingPrint') }}" method="post">
        @csrf
        <div class="row mt-5 text-center">
            <div class="col">
                <label for="browser">Choose Month:</label>
                <input list="months" name="month" id="browser">
                <datalist id="months">
                    <option value="01">
                    <option value="02">
                    <option value="03">
                    <option value="04">
                    <option value="05">
                    <option value="06">
                    <option value="07">
                    <option value="08">
                    <option value="09">
                    <option value="10">
                    <option value="11">
                    <option value="12">
                </datalist>
                @error('month')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col">
                <label for="browser">Choose Card Plan:</label>
                <input list="card" name="card" id="browser">
                <datalist id="card">
                    <option value="MPU_CLASSIC">
                    <option value="MPU_GOLD">
                    <option value="UPI_GOLD">
                    <option value="UPI_PLT">
                </datalist>
                @error('card')
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
