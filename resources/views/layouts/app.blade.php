<?php
$data = json_decode(file_get_contents('http://forex.cbm.gov.mm/api/latest'));
?>
<!DOCTYPE html>
<html lang="en">
@include('sweetalert::alert')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MOB Card_Settlement</title>
    <link rel="shortcut icon" href="{{ asset('Images/Icon.png') }}">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.css" rel="stylesheet" />
    <link href="/css/app.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,500' rel='stylesheet' type='text/css'>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.js"></script>
    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
</head>

<body>
    <div class="wrapper">
        <input type="checkbox" id="navigation" />
        <label id="label" for="navigation" title="MENU" class="hamburger-icon">
            <span></span>
            <span></span>
            <span></span>
        </label>
        </label>
        <nav>
            <a href="{{ route('home') }}"><img src="{{ asset('images/logo.png') }} "></a>
            <ul class="navScroll">
                @if (auth()->user()->department == 'Settlement' ||
                    auth()->user()->department == 'Admin' ||
                    auth()->user()->department == 'Card')
                    <li>
                        <a id="a" href="{{ route('JCBHome') }}"><span class="iconify" data-icon="logos:jcb"
                                data-width="20"></span>&nbsp; JCB Post Files News</a>
                    </li>
                    <li>
                        <a id="a" href="{{ route('UPIHome') }}"><span class="iconify" data-icon="logos:unionpay"
                                data-width="26"></span>&nbsp; Issuing UPI
                            Settlement</a>
                    </li>
                @endif
                @if (auth()->user()->department == 'Settlement' ||
                    auth()->user()->department == 'Admin' ||
                    auth()->user()->department == 'Card')
                    <li>
                        <a id="a" href="{{ route('visa') }}"><span class="iconify" data-icon="logos:visa"
                                data-width="25"></span>&nbsp; Visa Transactions Add</a>
                    </li>
                @endif
                @if (auth()->user()->department == 'Card' || auth()->user()->department == 'Admin')
                    <li>
                        <a id="a" href="{{ route('import') }}"><span class="iconify" data-icon="mdi:file-import"
                                style="color: #ff0000;" data-width="25"></span>&nbsp;Import
                            Merchant File</a>
                    </li>
                    <li>
                        <a id="a" href="{{ route('MPUHome') }}">MPU / UPI / JCB New Switch</a>
                    </li>
                    <li>
                        <a id="a" href="{{ route('ccy') }}"><span class="iconify"
                                data-icon="flat-color-icons:currency-exchange" data-width="25"></span>
                            Daily Currency Rate</a>
                    </li>
                    <li>
                        <a id="a" href="{{ route('atmhome') }}"><span class="iconify"
                                data-icon="emojione:atm-sign" data-width="20"></span>&nbsp;ATM Performance</a>
                    </li>
                    <li>
                        <a id="a" href="{{ route('cohome') }}">Customer Outstanding</a>
                    </li>
                    <li>
                        <a id="a" href="{{ route('cardhome') }}"><span class="iconify"
                                data-icon="noto-v1:credit-card" data-width="25"></span>&nbsp; MOB Debit Card List</a>
                    </li>
                    <li>
                        <a id="a" href="{{ route('credithome') }}"><span class="iconify"
                                data-icon="emojione:credit-card" data-width="25"></span>&nbsp; MOB Credit Card
                            Status</a>
                    </li>
                    <li>
                        <a id="a" href="{{ route('onushome') }}"><span class="iconify"
                                data-icon="fontisto:shopping-pos-machine" style="color: #ff0000;"
                                data-width="15"></span>&nbsp; Acquiring ONUS </a>
                    </li>
                    <li>
                        <a id="a" href="{{ route('AnnualFeeListingHome') }}">Annual Fee Listing</a>
                    </li>
                    <li>
                        <a id="a" href="{{ route('pssd01home') }}">PSSD_01</a>
                    </li>
                    <li>
                        <a id="a" href="{{ route('pssd02input') }}">PSSD_02</a>
                    </li>
                    <li>
                        <a id="a" href="{{ route('pssd04home') }}">PSSD_04</a>
                    </li>
                @endif
                @if (auth()->user()->department == 'Admin')
                    <li>
                        <a id="a" href="{{ route('userhome') }}">User Control&nbsp;<i
                                class='fa-solid fa-users-gear fa-lg' style='color: red'></i>
                            </i></a>
                    </li>
                @endif
            </ul>
            <p id="p">{{ auth()->user()->name }}&nbsp;({{ auth()->user()->department }})</p>
            <a class="logout-confirm" title="Logout" id="logout" href="{{ route('logout') }}"> <i
                    class="fas fa-sign-out-alt fa-lg"></i></a>
        </nav>

        <section>
            <div class="text-center">
                <strong class="cbm">CBM Exchange Rate Latest</strong><br>
                <strong class="cbm">USD - {{ $data->rates->USD }}</strong>
            </div>
            <main>
                @yield('content')
            </main>
        </section>
    </div>
    <footer> Copyright © 2020 - {{ date('Y') }} San Yu Aung. All Rights Reserved.</footer>
</body>

<script>
    ons.bootstrap();
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $('.logout-confirm').on('click', function(event) {
        event.preventDefault();
        const url = $(this).attr('href');
        Swal.fire({
            icon: 'warning',
            title: `Are you sure you want to Logout?`,
            // text: "If you delete this, it will be gone forever.",
            timer: 3000,
            showCancelButton: true,
            confirmButtonColor: 'LightSeaGreen',
            confirmButtonText: 'OK',
            cancelButtonColor: 'Crimson',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.value) {
                window.location.href = url;
            }
        })
    });
</script>

</html>
