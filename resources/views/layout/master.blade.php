<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">  
    {{-- <link rel="stylesheet" href="{{ asset('/asset/css/bootstrap.min.css') }}" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
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
    <script src="{{asset('/asset/js/jquerydatatable.js') }}"></script>
    <script src="{{asset('/asset/js/toaster.js') }}"></script>
    
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
</body>
</html>