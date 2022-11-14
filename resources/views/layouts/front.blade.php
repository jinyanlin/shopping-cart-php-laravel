<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title')
    </title>

    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- Styles-->
    <link href="{{ asset('frontend/css/bootstrap.css') }}" rel = "stylesheet">
    <link href="{{ asset('frontend/css/custom.css') }}" rel = "stylesheet">
     <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('frontend/css/owl.carousel.min.css') }}" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('frontend/css/owl.theme.default.min.css') }}" rel="stylesheet" />
    <!-- Scripts -->

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700&display=swap"
            rel="stylesheet">
            
     <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        a{
            text-decoration: none !important;
        }
    </style>
 
</head>
<body>
    @include('layouts.inc.frontendnav')
    
    <div class="content">
        @yield('content')
    </div>
       

    <script src="{{asset('admin/js/jquery.min.js')}}" defer></script>
    <script src="{{asset('admin/js/perfect-scrollbar.min.js')}}" defer></script>
    <script src="{{asset('admin/js/smooth-scrollbar.min.js')}}" defer></script>
    <script src="{{asset('admin/js/popper.min.js') }}" defer></script>

    <script src="{{ asset('frontend/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js')}}"></script>
    
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if (session('status'))
        <script>
            swal("{{session('status')}}");
        </script>
    @endif
   @yield('scripts')
</body>
</html>