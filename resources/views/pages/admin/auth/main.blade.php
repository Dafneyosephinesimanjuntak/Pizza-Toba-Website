<x-auth-layout title="Masuk">
    <div id="page_login">
        <div class="p-lg-5 p-4" >
            <div>
                <h2 class="text-primary">Selamat Datang PizzTob</h2>
            </div>

            <div class="mt-4">
                <form class="auth-login-form mt-2" id="login_form">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control " id="email" placeholder="Enter Email">
                        <div class="invalid-feedback">
                            Masukkan Username Anda
                        </div>   
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="password-input">Password</label>
                        <div class="position-relative auth-pass-inputgroup mb-3">
                            <input type="password" name="password" class="form-control pe-5  @error('password') is-invalid @enderror" placeholder="Enter password" id="password-input">
                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                            <div class="invalid-feedback">
                                Masukkan Password Anda
                            </div>   
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <button id="tombol_login" class="btn btn-success w-100" type="button" onclick="handle_post('#tombol_login','#login_form','{{route('admin.auth.login')}}','POST');">Login</button>
                    </div>
                </form>
            </div>

            <div class="mt-5 text-center">
                <p class="mb-0">Tidak Memiliki Akun? <a href="javascript:;" class="fw-semibold text-primary text-decoration-underline" onclick="auth_content('page_register');">Daftar Disini</a> </p>
            </div>
        </div>
    </div>
    @section('custom_js')
    <script>
        auth_content('page_login');
    </script>
    @endsection
</x-auth-layout>