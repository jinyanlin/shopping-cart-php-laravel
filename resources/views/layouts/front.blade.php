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
    <link href="{{ asset('frontend/css/userprofile.css') }}" rel = "stylesheet">
     <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('frontend/css/owl.carousel.min.css') }}" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('frontend/css/owl.theme.default.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
    @include('layouts.inc.frontendfooter')
    <script src="{{ asset('frontend/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('frontend/js/custom.js')}}"></script>
    <script src="{{ asset('frontend/js/checkout.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    
    <script>
          var availableTags = [];
          $.ajax({
            method: "GET",
            url: "/product-list",
            success: function (response){
                startAutoComplete(response);
            }
          });

          function startAutoComplete(availableTags){
            $( "#search-product" ).autocomplete({
                source: availableTags,
                clearButton: true
            });
          }
        </script>
    
    @if (session('status'))
        <script>
            swal("{{session('status')}}");
        </script>
    @endif
   @yield('scripts')
</body>
</html>
