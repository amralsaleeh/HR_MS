<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HR - Management System</title>

  <!-- REQUIRED CSS -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset ('backend/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset ('backend/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset ('backend/dist/css/custom.css') }}">
  <link rel="stylesheet" href="{{ asset ('backend/plugins/toastr/toastr.min.css') }}">
  <link rel="stylesheet" href="{{ asset ('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

  {{-- <link rel="stylesheet" href="{{ asset ('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset ('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <link rel="stylesheet" href="{{ asset ('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset ('backend/plugins/jqvmap/jqvmap.min.css') }}">
  <link rel="stylesheet" href="{{ asset ('backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <link rel="stylesheet" href="{{ asset ('backend/plugins/daterangepicker/daterangepicker.css') }}">
  <link rel="stylesheet" href="{{ asset ('backend/plugins/summernote/summernote-bs4.min.css') }}"> --}}

  @livewireStyles
  <!-- REQUIRED CSS -->

</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img src="{{ asset ('backend/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
    </div>

  <!-- Navbar -->
    @include('layouts.partials.navbar')

  <!-- Main Sidebar Container -->
    @include('layouts.partials.sidebar')

  <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        {{ $slot }}
    </div>

  <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
        </div>
    </aside>

  <!-- Main Footer -->
    @include('layouts.partials.footer')
</div>

<!-- REQUIRED SCRIPTS -->
<script src=" {{ asset ('backend/plugins/jquery/jquery.min.js') }}"></script>
<script src=" {{ asset ('backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src=" {{ asset ('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src=" {{ asset ('backend/dist/js/adminlte.min.js') }}"></script>
<script src=" {{ asset ('backend/plugins/toastr/toastr.min.js') }}"></script>
<script src=" {{ asset ('backend/plugins/moment/moment.min.js') }}"></script>
<script src=" {{ asset ('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>


{{-- <script src=" {{ asset ('backend/plugins/chart.js/Chart.min.js') }}"></script>
<script src=" {{ asset ('backend/plugins/sparklines/sparkline.js') }}"></script>
<script src=" {{ asset ('backend/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src=" {{ asset ('backend/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<script src=" {{ asset ('backend/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<script src=" {{ asset ('backend/plugins/moment/moment.min.js') }}"></script>
<script src=" {{ asset ('backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src=" {{ asset ('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src=" {{ asset ('backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src=" {{ asset ('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src=" {{ asset ('backend/dist/js/adminlte.js') }}"></script>
<script src=" {{ asset ('backend/dist/js/demo.js') }}"></script>
<script src=" {{ asset ('backend/dist/js/pages/dashboard.js') }}"></script> --}}
{{-- <script>
    $.widget.bridge('uibutton', $.ui.button)
</script> --}}
{{-- <script>
    $(document).ready( function() {
        $('#birthdate').datetimepicker({
            format: 'YYYY-MM-DD',
            viewMode: 'years'
        })
    })
</script> --}}

<script>
    $(document).ready(function() {
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-center",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    window.addEventListener('show_employer_form', event => {
        $('#employer-form').modal('show');
    })
    window.addEventListener('hide_employer_form', event => {
        $('#employer-form').modal('hide');
        toastr.success(event.detail.message, 'Success!');
    })
    window.addEventListener('show_conformation_model', event => {
        $('#conformation-model').modal('show');
    })
    window.addEventListener('hide_conformation_model', event => {
        $('#conformation-model').modal('hide');
        toastr.success(event.detail.message, 'Success!');
    })
    // Vacations
    window.addEventListener('show_new_daily_vacation_form', event => {
        $('#new-daily-vacation-form').modal('show');
    })
    window.addEventListener('show_new_hourly_vacation_form', event => {
        $('#new-hourly-vacation-form').modal('show');
    })

    // Tasks
    window.addEventListener('show_new_daily_task_form', event => {
        $('#new-daily-task-form').modal('show');
    })
    window.addEventListener('show_new_hourly_task_form', event => {
        $('#new-hourly-task-form').modal('show');
    })

})
</script>

@livewireScripts
<!-- REQUIRED SCRIPTS -->

</body>
</html>
