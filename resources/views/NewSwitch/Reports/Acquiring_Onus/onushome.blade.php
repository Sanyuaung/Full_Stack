@extends('layouts/app')
@section('content')
    @include('sweetalert::alert')
    <link href="/css/cardlist.css" rel="stylesheet">
    <div class="mt-5 text-center">
        <h2><strong>Acquiring Onus</strong>
        </h2>
    </div>
    <form action="{{ route('onusprint') }}" method="post">
        @csrf
        <div class="row mt-5">
            <div class="col">
                <div class="input-group mb-3">
                    <span class="input-group-text">Start Date&nbsp;<span class="iconify"
                            data-icon="flat-color-icons:calendar" data-width="25"></span></span>
                    <input name="startdate" min="2020-01-01" max="2022-12-31" class="form-control" type="text"
                        onfocus="(this.type='date')" id="date">
                </div>
                @error('startdate')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col">
                <div class="input-group mb-3">
                    <span class="input-group-text">End date&nbsp;<span class="iconify"
                            data-icon="flat-color-icons:calendar" data-width="25"></span></span>
                    <input name="enddate" min="2020-01-01" max="2022-12-31" class="form-control" type="text"
                        onfocus="(this.type='date')" id="date">
                </div>
                @error('enddate')
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
