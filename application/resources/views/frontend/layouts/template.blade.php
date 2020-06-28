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

    @include('frontend.layouts.js')

    @stack('customJs')

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/5c67b62e77e0730ce0433693/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
</body>
</html>
