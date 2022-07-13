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

    <!-- Main css -->
    <link rel="stylesheet" href="css/login.css">
    {{-- <script src="js/spinner.js"></script>
    <link rel="stylesheet" href="css/spinner.css"> --}}
    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
</head>

<body>
    @include('sweetalert::alert')
    {{-- <div id="loader" class="center"></div> --}}
    <div class="main">
        <a href="{{ route('forgetpasswordhome') }}" class="back">Back</a>
        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="new">Create New Password</h2>
                        @foreach ($old as $old)
                            <form method="POST" action="{{ route('updatePassword', $old->id) }}" class="register-form"
                                id="register-form">
                        @endforeach
                        @csrf
                        @error('username')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <div class="form-group">
                            <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input readonly type="text" name="username" id="name" value="{{ $old->name }}" />
                        </div>
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                            <input type="email" name="email" id="email" value="{{ $old->email }}" />
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
                            <input type="submit" name="signup" id="sidgnup" class="form-submit" value="Update" />
                        </div>
                        </form>
                    </div>
                    <div>
                        <figure><img src="images/forget_pwd.gif" alt="sing up image"></figure>
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
