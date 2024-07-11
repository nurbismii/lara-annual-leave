<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
  <title>
    Sistem Cuti Tahunan Created By HR
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('assets/css/soft-design-system.css?v=1.0.5') }}" rel="stylesheet" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  @stack('css')
</head>

<body class="index-page">
  <!-- Navbar -->
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        @include('layouts.navbar')
        <!-- End Navbar -->
      </div>
    </div>
  </div>
  <header class="header-2">
    <div class="page-header min-vh-75" style="background-image: url('./assets/img/curved-images/curved.jpg')">
      <div class="container">
        <div class="row">
          <div class="col-lg-7 text-center mx-auto">
            <h1 class="text-white pt-3 mt-n5">Selamat Datang!</h1>
            <p class="lead text-white mt-3">Sistem penginputan cuti tahunan <br /> created by HR </p>
          </div>
        </div>
      </div>
      <div class="position-absolute w-100 z-index-1 bottom-0">
        <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 40" preserveAspectRatio="none" shape-rendering="auto">
          <defs>
            <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
          </defs>
          <g class="moving-waves">
            <use xlink:href="#gentle-wave" x="48" y="-1" fill="rgba(255,255,255,0.40" />
            <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.35)" />
            <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.25)" />
            <use xlink:href="#gentle-wave" x="48" y="8" fill="rgba(255,255,255,0.20)" />
            <use xlink:href="#gentle-wave" x="48" y="13" fill="rgba(255,255,255,0.15)" />
            <use xlink:href="#gentle-wave" x="48" y="16" fill="rgba(255,255,255,0.95" />
          </g>
        </svg>
      </div>
    </div>
  </header>
  <!-- -------- START Content Presentation Docs ------- -->
  @yield('content')
  <!-- -------- END Content Presentation Docs ------- -->

  <footer class="footer pt-5 mt-5">
    <hr class="horizontal dark mb-5">
    <div class="container">
      <div class=" row">
        <div class="col-12">
          <div class="text-center">
            <p class="my-4 text-sm">
              All rights reserved. Copyright © <script>
                document.write(new Date().getFullYear())
              </script> Sistem Penginputan Cuti Tahunan <a href="https://www.creative-tim.com" target="_blank">Creative HR</a>.
            </p>
          </div>
        </div>
      </div>
    </div>
  </footer>
  @stack('scripts')
  <!--   Core JS Files   -->
  <script src="{{ asset('assets/js/core/popper.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js')}}" type="text/javascript"></script>
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <!--  Plugin for TypedJS, full documentation here: https://github.com/inorganik/CountUp.js -->
  <script src="{{ asset('assets/js/plugins/countup.min.js')}}"></script>
  <script src="{{ asset('assets/js/plugins/choices.min.js')}}"></script>
  <script src="{{ asset('assets/js/plugins/prism.min.js')}}"></script>
  <script src="{{ asset('assets/js/plugins/highlight.min.js')}}"></script>
  <!--  Plugin for Parallax, full documentation here: https://github.com/dixonandmoe/rellax -->
  <script src="{{ asset('assets/js/plugins/rellax.min.js')}}"></script>
  <!--  Plugin for TiltJS, full documentation here: https://gijsroge.github.io/tilt.js/ -->
  <script src="{{ asset('assets/js/plugins/tilt.min.js')}}"></script>
  <!--  Plugin for Selectpicker - ChoicesJS, full documentation here: https://github.com/jshjohnson/Choices -->
  <script src="{{ asset('assets/js/plugins/choices.min.js')}}"></script>
  <!--  Plugin for Parallax, full documentation here: https://github.com/wagerfield/parallax  -->
  <script src="{{ asset('assets/js/plugins/parallax.min.js')}}"></script>
  <!-- Control Center for Soft UI Kit: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('assets/js/soft-design-system.min.js?v=1.0.5')}}" type="text/javascript"></script>

  <script>
    @if(Session::has('success'))
    toastr.options = {
      "closeButton": true,
      "progressBar": true,
      'preventDuplicates': false,
      'showDuration': 5000,
      'hideDuration': 5000,
      'timeOut': 5000,
      'extendedTimeOut': 5000,
      'showEasing': 'swing',
      'hideEasing': 'linear',
      'showMethod': 'fadeIn',
      'hideMethod': 'fadeOut',
      'positionClass': 'toast-bottom-left'
    }
    toastr.success("{{ session('success') }}");
    @endif

    @if(Session::has('error'))
    toastr.options = {
      "closeButton": true,
      "progressBar": true,
      'preventDuplicates': false,
      'showDuration': 5000,
      'hideDuration': 5000,
      'timeOut': 5000,
      'extendedTimeOut': 5000,
      'showEasing': 'swing',
      'hideEasing': 'linear',
      'showMethod': 'fadeIn',
      'hideMethod': 'fadeOut',
      'positionClass': 'toast-bottom-left'
    }
    toastr.error("{{ session('error') }}");
    @endif

    @if(Session::has('info'))
    toastr.options = {
      "closeButton": true,
      "progressBar": true,
      'preventDuplicates': false,
      'showDuration': 5000,
      'hideDuration': 5000,
      'timeOut': 5000,
      'extendedTimeOut': 5000,
      'showEasing': 'swing',
      'hideEasing': 'linear',
      'showMethod': 'fadeIn',
      'hideMethod': 'fadeOut',
      'positionClass': 'toast-bottom-left'
    }
    toastr.info("{{ session('info') }}");
    @endif

    @if(Session::has('warning'))
    toastr.options = {
      "closeButton": true,
      "progressBar": true,
      'preventDuplicates': false,
      'showDuration': 5000,
      'hideDuration': 5000,
      'timeOut': 5000,
      'extendedTimeOut': 5000,
      'showEasing': 'swing',
      'hideEasing': 'linear',
      'showMethod': 'fadeIn',
      'hideMethod': 'fadeOut',
      'positionClass': 'toast-bottom-left'
    }
    toastr.warning("{{ session('warning') }}");
    @endif
  </script>

</body>

</html>
s