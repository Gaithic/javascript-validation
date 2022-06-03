<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  @yield('head')
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('/asset/admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style Main Style sheet -->
  <link rel="stylesheet" href="{{ asset('/asset/admin/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('/asset/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <link href="{{asset('/asset/css/toaster.css') }}" rel="stylesheet">
  <link href="{{asset('/asset/css/admin.css') }}" rel="stylesheet">
  <link href="{{asset('/asset/css/datatable.css') }}" rel="stylesheet">
  <script src="{{(asset('/asset/ajax/ajax.js'))}}"></script>


  @stack('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">

  @include('layout.inc.admin.adminnav')
  <div class="content-wrapper">
    @yield('breadcrumbs')
    @yield('content')
  </div>
@include('layout.inc.admin.footer')

<!-- jQuery -->
<script src="{{ asset('/asset/admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('/asset/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('/asset/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/asset/admin/dist/js/adminlte.js') }}"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="{{asset('/asset/js/toaster.js') }}"></script>
<script src="{{asset('/asset/js/jquerydatatable.js') }}"></script>
<script src="{{asset('/asset/js/datatables.js') }}"></script>
<script src="{{ asset('/asset/admin/plugins/chart.js/Chart.min.js') }}"></script>

@stack('scripts')


<script>
    $(document).ready(function() {
        toastr.options.timeOut = 10000;
        @if (Session::has('error'))
            toastr.error('{{ Session::get('error') }}');
        @elseif(Session::has('success'))
            toastr.success('{{ Session::get('success') }}');
        @endif
    });

</script>



@stack('scripts')

</body>
</html>
