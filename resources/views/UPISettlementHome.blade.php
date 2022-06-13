@extends('layouts.app')
@section('content')
    @include('sweetalert::alert')

    <link href="/css/mpu.css" rel="stylesheet">

    <div class="container mt-3 p-4">
        <h1 id="MPU" class="text-center">UPI Settlement</h1>
        <form class=" border border-light p-5" action="{{ route('UPIupload') }}" method="post"
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
                <button class="btn bg-danger btn-outline-danger" type="submit" id="inputGroupFileAddon03">
                    <span>UPI Upload&nbsp;<i class="fas fa-upload"></i></span>
                </button>
                <input type="file" name="upi" class="form-control btn-outline-danger text-warning" />
            </div>
        </form>
    </div>
@endsection
