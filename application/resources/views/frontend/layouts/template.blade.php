<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $CONF->title }} || @yield('pageTitle')</title>

    @include('frontend.layouts.css')
    @stack('customCss')
</head>
<body class="animsition">

    @include('frontend.layouts.header')

    @include('frontend.layouts.cart')

    @include('frontend.layouts.sidebar')

    @yield('content')

    @include('frontend.layouts.footer')

    {{--@include('frontend.layouts.preview')--}}

    @include('frontend.layouts.modal')

    @include('frontend.layouts.modal-checkout')

    @include('frontend.layouts.js')

    @stack('customJs')
</body>
</html>
