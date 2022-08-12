<!DOCTYPE html>
<html lang="en">
    @include('front.customer.layout.header')
    <body class="loading" data-layout-config='{"darkMode":false}'>
        @include('front.customer.layout.navbar')
        @yield('content')
        @if( isset( $not_home ) && $not_home != 'auth')
            @include('front.customer.layout.footer')
        @endif
        @include('front.customer.layout.scripts')
    </body>
</html>
