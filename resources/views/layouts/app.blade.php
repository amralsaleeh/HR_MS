<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HR - Management System</title>

  {{-- Favicon --}}
  <link rel="shortcut icon" type="image/x-icon" href="{{asset('backend/dist/img/AdminLTELogo.png')}}">

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

  <style>
    .modal-error {
        color: #636363;
        width: 325px;
        margin: 80px auto 0;
    }
    .modal-error .btn {
        color: #fff;
        border-radius: 4px;
        background: #ef513a;
        text-decoration: none;
        transition: all 0.4s;
        line-height: normal;
        border: none;
    }
    .modal-error .btn:hover {
        background: #da2c12;
        outline: none;
    }
    .modal-error .icon-box {
        color: #fff;
        position: absolute;
        margin: 0 auto;
        left: 0;
        right: 0;
        top: -70px;
        width: 95px;
        height: 95px;
        border-radius: 50%;
        z-index: 9;
        background: #ef513a;
        padding: 15px;
        text-align: center;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
    }
    /* Success Modal*/
    .modal-confirm {
        color: #636363;
        width: 325px;
        margin: 30px auto;
    }
    .modal-confirm.modal-dialog {
        margin-top: 80px;
    }
    .modal-confirm .btn {
        color: #fff;
        border-radius: 4px;
        background: #82ce34;
        text-decoration: none;
        transition: all 0.4s;
        line-height: normal;
        border: none;
    }
    .modal-confirm .btn:hover, .modal-confirm .btn:focus {
        background: #6fb32b;
        outline: none;
    }
    .modal-confirm .icon-box {
        color: #fff;
        position: absolute;
        margin: 0 auto;
        left: 0;
        right: 0;
        top: -70px;
        width: 95px;
        height: 95px;
        border-radius: 50%;
        z-index: 9;
        background: #82ce34;
        padding: 15px;
        text-align: center;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
    }
    .modal-confirm .btn {
        color: #fff;
        border-radius: 4px;
        background: #82ce34;
        text-decoration: none;
        transition: all 0.4s;
        line-height: normal;
        border: none;
    }
    .modal-confirm .btn:hover, .modal-confirm .btn:focus {
        background: #6fb32b;
        outline: none;
    }
    /* Success and Error Modal */
    .modal-error .modal-content, .modal-confirm .modal-content {
        padding: 20px;
        border-radius: 5px;
        border: none;
    }
    .modal-error .modal-header, .modal-confirm .modal-header {
        border-bottom: none;
        position: relative;
    }
    .modal-error h4, .modal-confirm h4 {
        text-align: center;
        font-size: 26px;
        margin: 30px 0 -15px;
    }
    .modal-error .form-control, .modal-error .btn, .modal-confirm .form-control, .modal-confirm .btn {
        min-height: 40px;
        border-radius: 3px;
    }
    .modal-error .close, .modal-confirm .close {
        position: absolute;
        top: -5px;
        right: -5px;
    }
    .modal-error .modal-footer, .modal-confirm .modal-footer {
        border: none;
        text-align: center;
        border-radius: 5px;
        font-size: 13px;
    }
    .modal-error .icon-box i, .modal-confirm .icon-box i  {
        font-size: 56px;
        position: relative;
        top: 4px;
    }
  </style>

  <!-- REQUIRED CSS -->

</head>

<body class="hold-transition sidebar-mini sidebar-collapse">
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

        $('#birthdate').on("change.datetimepicker", function(e)
        {
            alert('he');
        }
        )
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

    // Attendees
    window.addEventListener('show_attendees_form', event => {
        $('#attendees-form').modal('show');
    })
    window.addEventListener('show_error_model', event => {
        $('#attendees-form').modal('hide');
        toastr.success(event.detail.message, 'Error!');
    })

    // Employees
    window.addEventListener('show_employer_form', event => {
        $('#employer-form').modal('show');
    })
    window.addEventListener('hide_employer_form', event => {
        $('#employer-form').modal('hide');
        toastr.success(event.detail.message, 'Success!');
    })
    // window.addEventListener('show_unlink_conformation_model', event => {
    //     $('#unlink-conformation-model').modal('show');
    // })
    // window.addEventListener('hide_unlink_conformation_model', event => {
    //     $('#unlink-conformation-model').modal('hide');
    //     toastr.success(event.detail.message, 'Success!');
    // })
    window.addEventListener('show_delete_conformation_model', event => {
        $('#delete-conformation-model').modal('show');
    })
    window.addEventListener('hide_conformation_model', event => {
        $('#delete-conformation-model').modal('hide');
        toastr.success(event.detail.message, 'Success!');
    })

    window.addEventListener('show_import_form', event => {
        $('#import-form').modal('show');
    })

    // Centers
    window.addEventListener('show_center_form', event => {
        $('#center-form').modal('show');
    })
    window.addEventListener('hide_center_form', event => {
        $('#center-form').modal('hide');
        toastr.success(event.detail.message, 'Success!');
    })
    window.addEventListener('success_center_form', event => {
        toastr.success(event.detail.message, 'Success!');
    })

    // Departments
    window.addEventListener('show_department_form', event => {
        $('#department-form').modal('show');
    })
    window.addEventListener('hide_department_form', event => {
        $('#department-form').modal('hide');
        toastr.success(event.detail.message, 'Success!');
    })
    window.addEventListener('success_department_form', event => {
        toastr.success(event.detail.message, 'Success!');
    })

    // Postiions
    window.addEventListener('show_position_form', event => {
        $('#position-form').modal('show');
    })
    window.addEventListener('hide_position_form', event => {
        $('#position-form').modal('hide');
        toastr.success(event.detail.message, 'Success!');
    })
    window.addEventListener('success_postiion_form', event => {
        toastr.success(event.detail.message, 'Success!');
    })

    // Vacations
    window.addEventListener('show_new_daily_vacation_form', event => {
        $('#new-daily-vacation-form').modal('show');
    })
    window.addEventListener('hide_new_daily_vacation_form', event => {
        $('#new-daily-vacation-form').modal('hide');
        toastr.success(event.detail.message, 'Success!');
    })
    window.addEventListener('show_new_hourly_vacation_form', event => {
        $('#new-hourly-vacation-form').modal('show');
    })
    window.addEventListener('hide_new_hourly_vacation_form', event => {
        $('#new-hourly-vacation-form').modal('hide');
        toastr.success(event.detail.message, 'Success!');
    })
    window.addEventListener('show_employee_vacations_form', event => {
        $('#employee-vacations-form').modal('show');
    })

    // Tasks
    window.addEventListener('show_new_daily_task_form', event => {
        $('#new-daily-task-form').modal('show');
    })
    window.addEventListener('hide_new_daily_task_form', event => {
        $('#new-daily-task-form').modal('hide');
        toastr.success(event.detail.message, 'Success!');
    })
    window.addEventListener('show_new_hourly_task_form', event => {
        $('#new-hourly-task-form').modal('show');
    })
    window.addEventListener('hide_new_hourly_task_form', event => {
        $('#new-hourly-task-form').modal('hide');
        toastr.success(event.detail.message, 'Success!');
    })
    window.addEventListener('show_employee_tasks_form', event => {
        $('#employee-tasks-form').modal('show');
    })
})
</script>

<script type="text/javascript">
    @if (count($errors) > 0)
        $('#errorModal').modal('show');
    @endif

    @if(Session::get('success'))
    $('#confirmModal').modal('show');
    @endif
</script>

@livewireScripts
<!-- REQUIRED SCRIPTS -->

</body>
</html>
