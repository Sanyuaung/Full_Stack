<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MOB Card_Settlement</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="shortcut icon" href="{{ asset('Images/Icon.png') }}">
    <!-- Main css -->
    <link rel="stylesheet" href="css/login.css">
    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
    {{-- <script src="js/spinner.js"></script>
    <link rel="stylesheet" href="css/spinner.css"> --}}
</head>

<body>
    @include('sweetalert::alert')
    {{-- <div id="loader" class="center"></div> --}}
    <div class="main">
        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="images/signin-image.jpg" alt="sing up image"></figure>
                    </div>
                    <div class="signin-form">
                        <h2 class="form-title">Sign In</h2>
                        <form action="{{ route('login') }}" method="POST" class="register-form" id="login-form">
                            @csrf
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="email" id="your_name" placeholder="Email" />
                            </div>
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="your_pass" placeholder="Password" />
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit"
                                    value="Log in" />
                            </div>
                        </form>
                    </div>
                    <a href="{{ route('register') }}" class="signup-image-link"><span class="iconify"
                            data-icon="line-md:account-add" data-width="30"></span>Create an account</a>
                    <a href="{{ route('forgetpasswordhome') }}" class="signup-image-links"><span class="iconify"
                            data-icon="teenyicons:password-outline" data-width="25"></span>&nbsp;&nbsp;&nbsp;Forget
                        Password</a>
                </div>
            </div>
        </section>
    </div>

    <!-- JS -->
    <script src="js/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
