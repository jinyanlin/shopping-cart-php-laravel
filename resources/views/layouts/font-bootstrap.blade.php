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

      <!-- Icons. Uncomment required icon fonts -->
      <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

      <!-- Core CSS -->
      <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
      <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
      <link rel="stylesheet" href="../assets/css/demo.css" />
  
      <!-- Vendors CSS -->
      <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
  
      <!-- Page CSS -->
  
      <!-- Helpers -->
      <script src="../assets/vendor/js/helpers.js"></script>
  
      <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
      <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
      <script src="../assets/js/config.js"></script>
 
</head>
<body>
    
   {{--  <script src="{{ asset('frontend/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('frontend/js/custom.js')}}"></script>
    <script src="{{ asset('frontend/js/checkout.js')}}"></script>
    <script src="{{ asset('frontend/js/jquery.twzipcode.min.js')}}"></script>
    
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
    <!--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>-->

    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> --}}
    
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
