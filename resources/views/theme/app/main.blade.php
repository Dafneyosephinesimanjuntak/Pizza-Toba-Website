<!doctype html>
<html lang="en" data-layout="vertical" data-layout-style="detached" data-sidebar="light" data-topbar="dark" data-sidebar-size="lg">
@include('theme.app.head')
<body>
    <div id="layout-wrapper">
        @include('theme.app.header')
        @include('theme.app.aside')
        <div class="vertical-overlay"></div>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    {{$slot}}
                </div>
            </div>
            @include('theme.app.footer')
        </div>
    </div>
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    @include('theme.app.js')
    @yield('custom_js')
</body>
</html>