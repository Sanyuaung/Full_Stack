@extends('layouts/app')
@section('content')
    <link href="/css/co.css" rel="stylesheet">
    <div class="mt-5 mb-4 text-center">
        <h2><strong>Customer Oustanding reports</strong></h2>
    </div>
    <form action="{{ route('coprint') }}" method="post">
        @csrf
        @error('month')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        <div class="input-group mt-5">
            <span id="span" class="input-group-text">Report Date&nbsp;<span class="iconify"
                    data-icon="flat-color-icons:calendar" data-width="25"></span></span>
            <input name="month" type="text" onfocus="(this.type='month')" id="date" class="form-control" min="2020-01"
                max="2022-12" />
        </div>
        <div class="text-center">
            <button type="sumbit" class="btn btn-danger mt-5"><span class="iconify" data-icon="line-md:search"
                    data-width="20"></span><strong> Search</strong></button>
        </div>
    </form>
@endsection
