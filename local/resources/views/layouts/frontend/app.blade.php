<!DOCTYPE html>
<html lang="th">

<head>
    <title>บริษัท มารวยด้วยกัน จำกัด</title>
    @include('layouts.frontend.inc_header')
    @yield('css')
</head>

<body>
    @include('layouts.frontend.inc_navbar')
    @yield('conten')
    @include('layouts.frontend.inc_footer')
    <script>
        $('#linkMenuTop .nav-item').eq(0).addClass('active');
    </script>
</body>

@yield('script')

</html>
