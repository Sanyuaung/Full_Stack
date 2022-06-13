@extends('layouts.app')
@section('content')
    @include('sweetalert::alert')
    <link href="/css/jcb.css" rel="stylesheet">
    <div class="container mt-3 p-4">
        <h1 class="text-center">JCB Post Files</h1>
        <form class="border border-light p-5" action="{{ route('jcb') }}" method="post" enctype="multipart/form-data">
            @csrf

            @if (session('errors'))
                <div class="alert alert-danger">
                    {{ session('errors') }}
                </div>
            @endif
            <div class="input-group mb-3">
                <button class="btn bg-danger btn-outline-danger" type="submit" id="inputGroupFileAddon03">
                    <span>JCB Upload&nbsp;<i class="fas fa-upload"></i></span>
                </button>
                <input type="file" name="jcb" class="form-control btn-outline-danger text-warning" />
            </div>

        </form>
    </div>
@endsection
