@extends('layouts.app')
@section('content')
    <link href="/css/home.css" rel="stylesheet">
    @include('sweetalert::alert')
    <img id="img" src="{{ asset('images/home.png') }}">
@endsection
