<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <!--<link href="{{ asset('frontend/css/style.css') }}"
    <!-- Styles-->
    <link href="{{ asset('css/app.cs') }}" rel = "stylesheet">
    <link href="{{ asset('frontend/css/bootstrap.css') }}" rel = "stylesheet">
    <link href="{{ asset('frontend/css/custom.css') }}" rel = "stylesheet"> 

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="container">
        <div class="form sign-in-container">
            <form action="#">
                <h1>Sign in</h1>
                <div class="social-container">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <input type="email" placeholder="User Email">
                <input type="password" placeholder="Password">
                <a href="https://rpbloggers.com/">Forgot your password?</a>
                <button>Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-right">
                    <h1>Sign UP</h1>
                    <p>Sign up here if you don't have account.</p>
                    <button class="signup_btn">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script href="{{ asset('frontend/js') }}" rel = "stylesheet">
</body>
</html>
