@extends('layouts/app')
@section('content')
    <link href="/css/atm.css" rel="stylesheet">
    <div class="mt-5 mb-4 text-center">
        <a class="float-start mb-3" href="{{ route('pssd02input') }}" role="button"><span class="iconify"
                data-icon="akar-icons:arrow-back-thick" style="color: #2bd800;" data-width="25"></span></a>
        <h2 class="text-success"><strong>CBM Reports (PSSD_02)</strong></h2>
    </div>
    <form action="{{ route('pssd02print') }}" method="post">
        @csrf
        @error('date')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        <div class="input-group mt-5">
            <span id="span" class="input-group-text">select Date&nbsp;<span class="iconify"
                    data-icon="flat-color-icons:calendar" data-width="25"></span></span>
            <input name="date" min="2020-01-01" max="2022-12-31" type="text" onfocus="(this.type='date')"
                id="date" class="form-control" />
        </div>
        <div class="text-center">
            <button type="sumbit" class="btn btn-success mt-5"><span class="iconify" data-icon="line-md:search"
                    data-width="20"></span><strong> Search</strong></button>
        </div>
    </form>
@endsection
