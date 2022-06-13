<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MOB Card_Settlement</title>
    <link rel="shortcut icon" href="{{ asset('Images/Icon.png') }}">

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    {{-- <script src="js/spinner.js"></script>
    <link rel="stylesheet" href="css/spinner.css"> --}}
    <!-- Main css -->
    <link rel="stylesheet" href="css/login.css">
    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
</head>

<body>

    <div class="main">
        {{-- <div id="loader" class="center"></div> --}}
        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form" id="register-form">
                            @csrf
                            @error('username')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="username" id="name" placeholder="Your Name" />
                            </div>
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email" />
                            </div>
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="pass" placeholder="Password" />
                            </div>
                            @error('password_confirmation')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="password_confirmation" id="re_pass"
                                    placeholder="Repeat your password" />
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit"
                                    value="Register" />
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="{{ route('login') }}" class="signup-image-link">I am already register</a>
                    </div>
                </div>
            </div>
        </section>



    </div>

    <!-- JS -->
    <script src="js/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
