<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="no-js">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>{{ config('app.name', 'RIOCare India PVT LTD :: Inventory and Stock Management') }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />

    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/material-design-iconic-font.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/mdbootstrap4/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/mdbootstrap4/mdb.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/login.css') }}">
    <script src="{{ asset('assets/js/modernizr-2.6.2.min.js') }}"></script>
    <style>
    .bjp_background{background:#f5f5f5;}
    </style>
</head>
<body class="bjp_background">
    <div id="loader-wrapper">
        <div id="loader"></div>

        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>

    </div>
    <div class="container w-100">
        <div class="left_form">
            <div class="limiter">
                <div class="container-login100 pl-0 pb-0 pt-0">
                    @yield('content')

                </div>
            </div>
        </div>
    </div>

<div id="dropDownSelect1"></div>

<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/mdbootstrap4/popper.min.js') }}"></script>
<script src="{{ asset('assets/mdbootstrap4/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/mdbootstrap4/mdb.min.js') }}"></script>

<script src="{{ asset('assets/js/login.js') }}"></script>
</body>

</html>
