{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="/css/home.css" rel="stylesheet">
</head>

<body>
    <ul>
        <span id="maker"></span>
        <li><a href="">Home</a></li>
        <li><a href="">Home</a></li>
        <li><a href="">Home</a></li>
        <li><a href="">Home</a></li>
    </ul>





    <script>
        let maker = document.querySelector('#maker');
        let item = document.querySelectorAll('ul li a');

        function Indicator(e) {
            maker.style.top = e.offsetTop + 'px';
            maker.style.width = e.offsetWidth + 'px';
        }
        item.forEach(link => {
            link.addEventListener('mousemove', (e) => {
                Indicator(e.target);
            })
        })
    </script>
</body>

</html> --}}
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
