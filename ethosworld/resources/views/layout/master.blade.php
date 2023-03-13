<!DOCTYPE html>
<html lang="en">
  @include('layout.header')
  <body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__wobble" src="{{ asset('template/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
    </div>

    @include('layout.navbar')

    @include('layout.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      @yield('content')
    </div>
    <!-- /.content-wrapper -->

    @include('layout.footer')
  </div>
  <!-- ./wrapper -->

  REQUIRED SCRIPTS
  

  
  <script src="{{ asset('template/plugins/jquery/jquery.min.js')}}"></script>

<script src="{{ asset('template/plugins/jquery-ui/jquery-ui.min.js')}}"></script>

<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<script src="{{ asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{ asset('template/plugins/chart.js/Chart.min.js')}}"></script>

<script src="{{ asset('template/plugins/sparklines/sparkline.js')}}"></script>

<script src="{{ asset('template/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{ asset('template/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>

<script src="{{ asset('template/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<script src="{{ asset('template/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="{{ asset('template/plugins/moment/moment.min.js')}}"></script>
<script src="{{ asset('template/plugins/daterangepicker/daterangepicker.js')}}"></script>

<script src="{{ asset('template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>

<script src="{{ asset('template/plugins/summernote/summernote-bs4.min.js')}}"></script>

<script src="{{ asset('template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>

<script src="{{ asset('template/dist/js/adminlte.js?v=3.2.0')}}"></script>

<script src="{{ asset('template/dist/js/demo.js')}}"></script>

<script src="{{ asset('template/dist/js/pages/dashboard.js')}}"></script>
  </body>
</html>
