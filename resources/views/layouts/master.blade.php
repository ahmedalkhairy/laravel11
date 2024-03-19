<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('partials.head')
<body class="iq-page-menu-horizontal right-column-fixed">
<!-- Wrapper Start -->
<div class="wrapper">
    <!-- Sidebar  -->
@include('partials.horizontal-menu')
<!-- Sidebar End -->
    <!-- Page Content  -->
    @yield('content')
</div>
<!-- Wrapper END -->

@include('partials.footer')

</body>
</html>
