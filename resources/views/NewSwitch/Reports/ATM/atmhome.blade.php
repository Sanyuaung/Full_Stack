@extends('layouts/app')
@section('content')
    <link href="/css/atm.css" rel="stylesheet">
    <div class="mt-3 mb-4 text-center">
        <h2><strong>atm performance reports</strong></h2>
    </div>
    <form action="{{ route('print') }}" method="post">
        @csrf
        @error('start')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        <div class="input-group mb-4">
            <span id="span" class="input-group-text">Start Date&nbsp;<span class="iconify"
                    data-icon="flat-color-icons:calendar" data-width="25"></span></span>
            <input name="start" min="2020-01-01" max="2022-12-31" type="text" onfocus="(this.type='date')" id="date" class="form-control" />
        </div>
        @error('end')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        <div class="input-group mb-4">
            <span id="span" class="input-group-text">end Date&nbsp;<span class="iconify"
                    data-icon="flat-color-icons:calendar" data-width="25"></span></span>
            <input name="end" min="2020-01-01" max="2022-12-31" type="text" onfocus="(this.type='date')" id="date" class=" form-control" />
        </div>
        <div class="text-center">
            <button type="sumbit" class="btn btn-danger mt-5"><span class="iconify" data-icon="line-md:search"
                    data-width="20"></span><strong> Search</strong></button>
        </div>
    </form>
@endsection
