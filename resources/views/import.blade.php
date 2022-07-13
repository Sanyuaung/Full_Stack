@extends('layouts.app')
@section('content')
    @include('sweetalert::alert')
    <link href="/css/mpu.css" rel="stylesheet">
    <div class="container mt-3 p-1">
        <h1 id="MPU" class="text-center">Merchant Import</h1>
        <a onclick="return confirm('Are you sure you want to export?')" href="{{ route('export') }}" class="float-right">
            Export File </a>
        <form class=" border mt-3 border-light p-1" action="{{ route('importfile') }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @if (session('errors'))
                <div class="alert alert-danger">
                    {{ session('errors') }}
                </div>
            @endif
            <div class="input-group mb-3">
                <button class="btn bg-danger btn-outline-danger" type="submit" id="inputGroupFileAddon03">
                    <span>Import File&nbsp;<i class="fas fa-upload"></i></span>
                </button>
                <input type="file" name="file" accept=".xlsx"
                    class="form-control btn-outline-danger text-warning" />&nbsp;&nbsp;
                <a href="{{ route('delete') }}"> <span class="iconify" data-icon="icon-park:delete-themes"
                        data-width="33"></span> </a>
            </div>
        </form>
    </div>
@endsection
