<!DOCTYPE html>
<html lang="en">
    @include('front.customer.layout.header')
    <body class="loading" data-layout-config='{"darkMode":false}'>
        @include('front.customer.layout.navbar')
        @yield('content')
        @include('front.customer.layout.footer')
        @include('front.customer.layout.scripts')
    </body>
</html>
