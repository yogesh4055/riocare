<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Rio Care Inventory and Stock Management') }} - @yield('title')</title>


    <link rel="stylesheet" href="{{ asset('assets/mdbootstrap4/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/mdbootstrap4/mdb.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/mdbootstrap4/mdb-plugins-gathered.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">

    <style>
        .error {
            color: red;
            font-size: 13px;
        }

        label.error {

            color: red;
            font-size: 1rem;
            display: block;
            margin-top: 5px;
        }

        input.error,
        textarea.error {
            border: 1px dashed red;
            font-weight: 300;
            color: red;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        @include("header.top")
        <div class="container-fluid page-body-wrapper">
            @include("header.navigation")

            <!-- Main Container -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                    <div class="copyright">
                        Copyright 2021. all rights are reserved.<b>Version 1.0</b>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @stack('models')
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('/assets/mdbootstrap4/jquery.min.js') }}"></script>
    <script src="{{ asset('/assets/mdbootstrap4/popper.min.js') }}"></script>
    <script src="{{ asset('/assets/mdbootstrap4/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/assets/js/feather.min.js')  }}"></script>
    
    <script src="//cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="//unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
    @stack('custom-scripts')
    <script>
        feather.replace()
    </script>
    @stack('scripts')

</body>

</html>
