<!DOCTYPE html>
<html lang="en">
@include('theme.auth.head')
<body>
    <!-- auth-page wrapper -->
    <div>
        <img src="{{asset('images/img/logo_piztob.jpeg')}}" class="rounded-circle" style="width: 150px; position:absolute; margin-left:30px; margin-top:30px;" alt="">
    </div>
    <div class="auth-page-wrapper py-5 d-flex justify-content-center align-items-center min-vh-100" style="background-image: url({{asset('images/img/piztob_login.jpeg')}}); background-repeat: no-repeat; background-size:cover;">
        <div class="auth-page-content overflow-hidden ">
            <h2 class="text-center pb-5 text-white fs-48">Pizza Toba</h2>
            <div class="container col-lg-4 mt-5">
                <div class="card overflow-hidden border-0" style="background: rgb(123, 66, 66, 0.6);">
                    {{$slot}}
                </div>
            </div>
        </div>
        @include('theme.auth.footer')
    </div>
    @include('theme.auth.js')
    @yield('custom_js')
</body>
</html>