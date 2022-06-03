<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('head')
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">   --}}
    <link rel="stylesheet" href="{{ asset('/asset/css/bootstrap.min.css') }}">
    <script src="{{(asset('/asset/ajax/ajax.js'))}}"></script>
    <link href="{{asset('/asset/css/toaster.css') }}" rel="stylesheet"> 
    <title>
        @isset($title)
            {{ $title }}  |
        @endisset
          {{ config('app.name') }}
    </title>
    @stack('styles')
</head>
<body>
    @include('layout.inc.messages')
    @include('layout.inc.navbar')
    @yield('content')
    <script defer src="{{ asset('/asset/users/registerFormValidation.js') }}"></script>
    <script defer src="{{ asset('/asset/users/loginFormValidation.js') }}"></script>
    <script src="{{asset('/asset/js/jquerydatatable.js') }}"></script>
    <script src="{{asset('/asset/js/toaster.js') }}"></script>
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });
        
    </script>
    
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
<script>
     $(document).ready(function () {
 
        $('ul.navbar-nav > li')
                .click(function (e) {
            $('ul.navbar-nav > li')
                .removeClass('active');
            $(this).addClass('active');
        });
    });
</script>
</body>
</html>