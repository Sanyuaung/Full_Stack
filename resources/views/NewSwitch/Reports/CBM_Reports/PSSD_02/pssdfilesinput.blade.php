@extends('layouts/app')
@section('content')
    @include('sweetalert::alert')
    <link href="/css/atm.css" rel="stylesheet">
    <div class="container mt-3 p-4">
        <h1 id="MPU" class="text-center text-success">Files Input for PSSD_02</h1>
        <form class=" border border-light p-5" action="{{ route('fileinsert') }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @if (session('errors'))
                <div class="alert alert-danger">
                    {{ session('errors') }}
                </div>
            @endif

            @if (session('nodata'))
                <div class="alert alert-danger">
                    {{ session('nodata') }}
                </div>
            @endif
            <div class="input-group mb-3">
                <button class="btn bg-success btn-outline-success" type="submit" id="inputGroupFileAddon03">
                    <span class="text-white">Files Upload&nbsp;<i class="fas fa-upload"></i></span>
                </button>
                <input type="file" name="file" class="form-control btn-outline-success text-success" />
            </div>
        </form>
        <div class="text-center">
            <a href="{{ route('pssd02home') }}" type="sumbit" class="btn btn-success"><strong> Continue</strong></a>
        </div>
    </div>
@endsection
