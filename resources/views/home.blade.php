@extends('layouts.app')
@section('content')
    <link href="/css/home.css" rel="stylesheet">
    {{-- <script src="js/spinner.js"></script>
    <link rel="stylesheet" href="css/spinner.css">
    <div id="loader" class="center"></div> --}}
    @include('sweetalert::alert')
    {{-- <h1 id="HOME" class="text-center">Myanmar Oriental Bank</h1> --}}
    <img id="img" src="{{ asset('images/home.png') }}">
@endsection
